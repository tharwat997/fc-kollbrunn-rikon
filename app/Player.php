<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'playerNumber', 'age' , 'team_id' , 'total_goals', 'yellow_cards', 'red_cards', 'assists', 'date_joined','image'
    ];
}
