<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $fillable=["user_id","followed_id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function usersFollowing()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}