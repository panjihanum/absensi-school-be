<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['nim', 'full_name', 'date_of_birth', 'address'];

    public function lessonClasses()
    {
        return $this->belongsToMany(LessonClass::class, 'student_lesson_classes')
            ->withPivot('is_presence', 'is_permission', 'permission_detail')
            ->withTimestamps();
    }

    public function studentParents()
    {
        return $this->hasMany(StudentParent::class);
    }
}
