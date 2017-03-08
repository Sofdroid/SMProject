<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Comment;
use App\Like;
use App\Tag;
use App\TagPost;
use App\Event;
use App\Participation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastname', 'weight', 'size', 'gender', 'manuality', 'birthday', 'job', 'phonenumber', 'adress', 'favoritemusic', 'favoritemovies', 'politicalview', 'religiousview', 'aboutme'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post)
    {
        $this->post()->save($post);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment(Comment $comment)
    {
        $this->comment()->save($comment);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function addLike(Like $like)
    {
        $this->like()->save($like);
    }

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function addTag(Tag $tag)
    {
        $this->tag()->save($tag);
    }

    public function tagPost()
    {
        return $this->hasMany(TagPost::class);
    }

    public function addTagPost(TagPost $tag)
    {
        $this->tagPost()->save($tag);
    }

    public function follow()
    {
        return $this->hasMany(Follow::class);
    }

    public function addfollow(Follow $follow)
    {
        $this->follow()->save($follow);
    }

    // event
    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function addEvent(Event $event)
    {
        $this->event()->save($event);
    }

    // participation 

    public function participation()
    {
        return $this->hasMany(Participation::class);
    }

    public function addParticipation(Participation $participation)
    {
        $this->participation()->save($participation);
    }


}
