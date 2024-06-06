<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ParentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('teacher/register', [TeacherAuthController::class, 'register']);
    Route::post('parent/register', [ParentAuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('user')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [AuthController::class, 'getUser']);
});

Route::prefix('presence')->group(function () {
    Route::get('/{student_id}', [PresenceController::class, 'getPresenceByStudentId']);
});


Route::middleware(['auth:sanctum', 'role:PARENT'])->prefix('/parent')->group(function () {
    Route::get('/students', [StudentController::class, 'getStudentsByParent']);
});
