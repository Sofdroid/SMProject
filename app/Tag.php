<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TagPost;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'value'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagPost()
    {
    	return $this->hasMany(TagPost::class);
    }

}