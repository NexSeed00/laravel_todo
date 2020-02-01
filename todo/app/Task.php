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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
