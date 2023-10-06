<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;
    protected $fillable = ['token', 'username', 'user_id', 'expires_at'];
    protected $hidden = ['token'];
}
