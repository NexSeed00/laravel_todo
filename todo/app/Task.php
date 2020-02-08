<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'contents',
        'user_id',
        'image_at',
    ];

    public function isBookmarkedByUser($user)
    {
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bookmarks()
    {
        return $this->belongsToMany('App\User', 'bookmarks')->withTimestamps();
    }
}
