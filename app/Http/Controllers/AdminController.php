<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\ClassTeacher;
use App\Models\AcademicYear;
use App\Models\ChatRoom;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $school = School::first();

        $stats = [
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_guardians' => User::where('role', 'guardian')->count(),
            'total_students' => Student::count(),
            'total_classes' => SchoolClass::count(),
            'total_subjects' => Subject::count(),
            'total_chat_rooms' => ChatRoom::count(),
            'quiet_hours_active' => $school ? $school->isCurrentlyQuietHours() : false,
        ];

        $classes = SchoolClass::with(['homeroomTeacher.teacher', 'students'])->get();
        $recentAudits = AuditLog::with('user')->latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact('school', 'stats', 'classes', 'recentAudits'));
    }

    public function school()
    {
        $school = School::first();
        return view('admin.school', compact('school'));
    }

    public function updateSchool(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'required|string|max:20',
            'quiet_start' => 'required',
            'quiet_end' => 'required',
            'timezone' => 'required|string',
        ]);

        $school = School::first();
        if ($school) {
            $school->update($request->only('name', 'npsn', 'address', 'phone', 'quiet_start', 'quiet_end', 'timezone'));

            AuditLog::create([
                'user_id' => auth()->id(),
                'school_id' => $school->id,
                'action' => 'update_school_settings',
                'entity' => 'school',
                'entity_id' => $school->id,
                'details' => ['quiet_start' => $request->quiet_start, 'quiet_end' => $request->quiet_end],
                'ip_address' => $request->ip(),
            ]);
        }

        return back()->with('success', 'Pengaturan sekolah dan Jam Tenang berhasil diperbarui.');
    }

    public function classes()
    {
        $classes = SchoolClass::with(['academicYear', 'students', 'homeroomTeacher.teacher'])->get();
        $academicYears = AcademicYear::all();
        return view('admin.classes', compact('classes', 'academicYears'));
    }

    public function subjects()
    {
        $subjects = Subject::withCount('classTeachers')->get();
        return view('admin.subjects', compact('subjects'));
    }

    public function classTeachers()
    {
        $assignments = ClassTeacher::with(['class', 'teacher', 'subject'])->get();
        $classes = SchoolClass::all();
        $teachers = User::where('role', 'teacher')->get();
        $subjects = Subject::all();

        return view('admin.class-teachers', compact('assignments', 'classes', 'teachers', 'subjects'));
    }

    public function users()
    {
        $teachers = User::where('role', 'teacher')->with('teacherProfile')->get();
        $guardians = User::where('role', 'guardian')->with('students')->get();

        return view('admin.users', compact('teachers', 'guardians'));
    }

    public function studentGuardians()
    {
        $relations = StudentGuardian::with(['student.class', 'guardian'])->get();
        $students = Student::with('class')->get();
        $guardians = User::where('role', 'guardian')->get();

        return view('admin.student-guardians', compact('relations', 'students', 'guardians'));
    }

    public function auditLogs()
    {
        $logs = AuditLog::with('user')->latest('created_at')->paginate(20);
        $chatRooms = ChatRoom::with(['student', 'teacher', 'guardian', 'subject', 'class'])->get();

        return view('admin.audit-logs', compact('logs', 'chatRooms'));
    }
}

