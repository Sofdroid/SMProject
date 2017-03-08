<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
use App\Tag;

class TagPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'tag_id', 'post_id','user_id','tag_value'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}