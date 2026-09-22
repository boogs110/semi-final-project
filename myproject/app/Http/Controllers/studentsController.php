<?php

namespace App\Http\Controllers;

class studentsController extends Controller
{
    public function index()
    {
        return view('students.index');
    }
}