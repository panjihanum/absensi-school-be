<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ParentProfile extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_parents', 'parent_id', 'student_id');
    }
}
