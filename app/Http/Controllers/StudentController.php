<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Program;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('program')->get();
        $programs = Program::all(); 

        return view('students', compact('students', 'programs'));
    }

    public function addUser(Request $request){
        $validated = $request->validate([
            'student_number' => 'required',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'program_id' => 'required|exists:program,id',
        ]);
    
        Student::create([
            'student_number' => $validated['student_number'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'program_id' => $validated['program_id'],
        ]);
    
        return redirect()->back()->with('success', 'Student added successfully!');
    }

    public function scan(Request $request)
        {
            $barcode = $request->input('barcode');
            
            $student = Student::with('program', 'payments')->where('student_number', $barcode)->first();

            return view('payment', compact('student'));
        }
}
