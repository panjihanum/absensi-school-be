<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['full_name', 'date_of_birth', 'address', 'phone_number', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
