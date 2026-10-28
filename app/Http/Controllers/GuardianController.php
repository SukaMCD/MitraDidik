<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Subject;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Carbon\Carbon;

class GuardianController extends Controller
{
    public function dashboard(Request $request)
    {
        $guardian = auth()->user();

        // Ambil daftar anak yang terhubung ke orang tua ini
        $guardiansStudents = $guardian->students()->with('class')->get();

        if ($guardiansStudents->isEmpty()) {
            return view('guardian.no-child');
        }

        // Tentukan anak yang sedang aktif dilihat
        $studentId = $request->query('student_id');
        $activeStudent = $studentId
            ? $guardiansStudents->firstWhere('id', $studentId)
            : $guardiansStudents->first();

        if (!$activeStudent) {
            $activeStudent = $guardiansStudents->first();
        }

        // 1. Presensi Hari Ini
        $todayAttendance = Attendance::where('student_id', $activeStudent->id)
            ->whereDate('att_date', Carbon::today())
            ->first();

        // 2. Mata Pelajaran & Kartu Gaya Google Classroom untuk Kelas Anak
        $classId = $activeStudent->class_id;
        $subjects = Subject::whereHas('classTeachers', function ($q) use ($classId) {
            $q->where('class_id', $classId);
        })->with(['classTeachers' => function ($q) use ($classId) {
            $q->where('class_id', $classId)->with('teacher');
        }])->get();

        // 3. Tugas Mendatang untuk Anak
        $upcomingAssignments = Assignment::where('class_id', $classId)
            ->with(['subject', 'submissions' => function ($q) use ($activeStudent) {
                $q->where('student_id', $activeStudent->id);
            }])
            ->where(function ($q) {
                $q->whereNull('due_date')->orWhere('due_date', '>=', Carbon::now()->subDay());
            })
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        // 4. Pesan Terbaru dari Guru
        $recentChatRooms = ChatRoom::where('student_id', $activeStudent->id)
            ->where('guardian_id', $guardian->id)
            ->with(['teacher', 'subject', 'messages' => function ($q) {
                $q->latest()->take(1);
            }])
            ->get();

        // 5. Saldo Poin Karakter
        $behaviorProfile = $activeStudent->behaviorProfile;

        return view('guardian.dashboard', compact(
            'guardian',
            'guardiansStudents',
            'activeStudent',
            'todayAttendance',
            'subjects',
            'upcomingAssignments',
            'recentChatRooms',
            'behaviorProfile'
        ));
    }
}

