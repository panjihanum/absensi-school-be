<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonClass;
use App\Models\StudentLessonClass;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Notifications\FirebasePushNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function attendance(Request $request)
    {
        $notification = new FirebasePushNotification();


        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|uuid',
            'student_ids' => 'array',
            'student_ids.*' => 'uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lessonClass = LessonClass::firstWhere('id', $request->lesson_id);
        $studentLessons = StudentLessonClass::where('lesson_class_id', $request->lesson_id)
            ->with(['student'])->get();

        foreach ($studentLessons as $studentLesson) {
            if (in_array($studentLesson->student_id, $request->student_ids)) {
                if ($studentLesson->is_presence == false) {
                    $parent = User::whereHas(
                        'parentProfile',
                        function ($q2) use ($studentLesson) {
                            $q2->whereHas('studentParents', function ($q) use ($studentLesson) {
                                $q->where('student_id', $studentLesson->student_id);
                            });
                        }
                    )->with(['fcmUserIds'])->first();

                    $parent->fcmUserIds->each(function ($fcmUserId) use ($studentLesson, $lessonClass, $notification) {
                        $notification->setMessage(
                            $fcmUserId->fcm_token,
                            "Halo Bu/Bapak.",
                            $studentLesson->student->full_name . "hadir yak dalam mata pelajaran " . $lessonClass->lesson . "\nTerima Kasih."
                        );

                        $notification->sendMessage();
                    });
                }
                $studentLesson->is_presence = true;
            } else {
                $studentLesson->is_presence = false;
            }
            $studentLesson->save();
        }

        return response()->json(['message' => 'Data Absen Berhasil.']);
    }

    public function getByDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_lesson' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacher = TeacherProfile::where('user_id', $request->user()->id)->first();

        $lessons = LessonClass::where('teacher_id', $teacher->id)
            ->where('date_lesson', $request->date_lesson)
            ->orderBy('date_lesson')
            ->with(['students'])
            ->get();

        return response()->json(['message' => 'Get Data Success.', 'data' => $lessons]);
    }

    public function getByStudentIdAndDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|uuid',
            'date_lesson' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lessons = LessonClass::whereHas('students', function ($query) use ($request) {
            $query->where('student_id', $request->student_id);
        })
            ->where('date_lesson', $request->date_lesson)
            ->orderBy('date_lesson')
            ->with(['students' => function ($query) use ($request) {
                $query->where('student_id', $request->student_id);
            }])
            ->get();

        return response()->json(['message' => 'Get Data Success.', 'data' => $lessons]);
    }
}
