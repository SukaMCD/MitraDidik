<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\Student;
use App\Models\User;

class ShowcaseController extends Controller
{
    public function index()
    {
        $school = School::first();
        $sampleStudent = Student::first();
        $sampleTeacher = User::where('role', 'teacher')->first();

        return view('showcase', compact('school', 'sampleStudent', 'sampleTeacher'));
    }
}

