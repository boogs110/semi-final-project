<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentsController;
use App\Http\Controllers\subjectsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students',[studentsController::class, 'index']);

Route::get('/subjects',[subjectsController::class, 'index']);
