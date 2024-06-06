<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudentsByParent(Request $request)
    {
        $user = $request->user();

        $parentProfile = ParentProfile::where('user_id', $user->id)->firstOrFail();

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $students = $parentProfile->students()->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Students retrieved successfully.',
            'data' => $students
        ]);
    }
}
