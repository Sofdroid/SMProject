<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Like;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body'
    ];

    public function comment()
    {
    	return $this->hasMany(Comment::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}