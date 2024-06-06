<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class School extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'government_name',
        'type',
        'address',
        'phone',
        'postal_code'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_schools')
            ->withPivot('is_active', 'is_graduated')
            ->withTimestamps();
    }
}
