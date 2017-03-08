<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\User;
class Participation extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
