<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\ClassTeacher;
use App\Models\AttendanceRequest;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Student;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = auth()->user();

        // Kelas yang diampu guru ini (sebagai wali kelas & mapel)
        $classTeachers = ClassTeacher::where('teacher_id', $teacher->id)
            ->with(['class.students', 'subject'])
            ->get();

        $homeroomAssignment = $classTeachers->firstWhere('is_homeroom', true);
        $homeroomClass = $homeroomAssignment ? $homeroomAssignment->class : null;

        // Permohonan izin yang pending untuk kelas yang diampu guru ini
        $pendingLeaveRequests = 0;
        if ($homeroomClass) {
            $studentIds = $homeroomClass->students->pluck('id');
            $pendingLeaveRequests = AttendanceRequest::whereIn('student_id', $studentIds)
                ->where('status', 'pending')
                ->count();
        }

        // Tugas aktif yang dibuat guru ini
        $activeAssignments = Assignment::where('teacher_id', $teacher->id)
            ->with(['subject', 'class'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact('teacher', 'classTeachers', 'homeroomClass', 'pendingLeaveRequests', 'activeAssignments'));
    }
}

