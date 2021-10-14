<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'is_published', 'user_id'];
    // protected $with = ['comments'];
    public static function unpublished()
    {
        return self::with('comments')->where('is_published', false);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
