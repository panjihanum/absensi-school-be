<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLessonClass extends Model
{
    use HasFactory, Uuid;

    protected $table = 'student_lesson_classes';

    protected $fillable = ['student_id', 'lesson_class_id', 'is_presence', 'is_permission', 'permission_detail'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lessonClass()
    {
        return $this->belongsTo(LessonClass::class);
    }
}
