<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/fcm-token/add', [AuthController::class, 'updateFCMToken']);
    Route::post('/fcm-token/remove', [AuthController::class, 'removeFCMToken']);

    Route::get('/user', function (Request $request) {
        return User::where(['id' => $request->user()->id])->with(['parentProfile', 'teacherProfile', 'roles'])->first();
    });
});

Route::middleware(['auth:sanctum', 'role:PARENT'])->group(function () {
    Route::get('/lessons/student', [LessonController::class, 'getByStudentIdAndDate']);
    Route::get('/students/parent', [StudentController::class, 'getByParentId']);
});


Route::middleware(['auth:sanctum', 'role:TEACHER'])->group(function () {
    Route::get('/lessons/teacher', [LessonController::class, 'getByDate']);
    Route::post('/lessons/attendance', [LessonController::class, 'attendance']);
});
