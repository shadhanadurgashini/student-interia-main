<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use domain\Facades\StudentFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StudentController extends ParentController
{
    
    public function index()
    {
        return Inertia::render('Student/index');
    }

    //Function to store data
    public function create(Request $request)
    {
        return StudentFacade::create($request->all());
    }

    public function list()
    {
        $students = StudentFacade::all();
        return response()->json($students);
    }

    public function get($student_id)
    {
        $student = StudentFacade::get($student_id);
        return response()->json($student);
    }

    //Function to delete data
    public function delete($student_id)
    {
        return StudentFacade::delete($student_id);
    }

    //Function to alter status
    public function active($student_id)
    {
        return StudentFacade::active($student_id);
    }

    public function edit(Request $request)
    {
        $response['student'] = StudentFacade::get($request['student_id']);
        return view('pages.student.edit')->with($response);
    }

    public function update(Request $request, $student_id)
    {
        return StudentFacade::update($request->all(), $student_id);
    }
}