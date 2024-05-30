<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getByParentId(Request $request)
    {

        $parentProfile = ParentProfile::where('user_id', $request->user()->id)->first();
        $students = Student::whereHas('studentParents', function ($q) use ($parentProfile) {
            $q->where('parent_profile_id', $parentProfile->id);
        })->get();

        return response()->json($students);
    }
}
