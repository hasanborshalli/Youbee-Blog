<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory,SoftDeletes,Searchable;
    protected $fillable=["title","content","user_id"];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    public function is_liked_by_user()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}