<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['student_id', 'parent_profile_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function parentProfile()
    {
        return $this->belongsTo(ParentProfile::class);
    }
}
