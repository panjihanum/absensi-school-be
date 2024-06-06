<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relationships
    public function parents()
    {
        return $this->belongsToMany(ParentProfile::class, 'student_parents');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'student_schools')
            ->withPivot('is_active', 'is_graduated')
            ->withTimestamps();
    }
}
