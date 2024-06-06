<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function getPresenceByStudentId(Request $request, $studentId)
    {
        $request->validate([
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = Presence::where('student_id', $studentId);

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->has('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        } elseif ($request->has('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        if ($request->has('per_page') || $request->has('page')) {
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);
            $presence = $query->paginate($perPage, ['*'], 'page', $page);
        } else {
            $presence = $query->paginate(10);
        }

        return response()->json([
            'message' => 'Presence records retrieved successfully.',
            'data' => $presence
        ]);
    }
}
