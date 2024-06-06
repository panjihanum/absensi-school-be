<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Presence extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'date',
        'is_presence',
        'is_absence',
        'desc_absence',
        'is_permission',
        'desc_permission'
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
}
