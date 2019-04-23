<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TickerEvents extends Model
{
    protected $fillable = [
        'match_id', 'title', 'description', 'minute_of_event', 'player_idHome', 'playerNameAway',
        'yellow_card', 'red_card', 'injury', 'assist', 'goal', 'substitute',
    ];
}
