<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['full_name', 'nip', 'phone_number', 'address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessonClasses()
    {
        return $this->hasMany(LessonClass::class, 'teacher_id');
    }
}
