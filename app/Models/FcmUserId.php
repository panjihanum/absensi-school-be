<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmUserId extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['fcm_token', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
