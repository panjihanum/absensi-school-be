<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonClass extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'lesson', 'date_lesson',
        'start_time_lesson', 'end_time_lesson', 'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_lesson_classes')
            ->withPivot('is_presence', 'is_permission', 'permission_detail')
            ->withTimestamps();
    }
}
