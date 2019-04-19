<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'match_type', 'type_name', 'teamA_id', 'teamA_score' , 'teamA_score' ,
        'teamB_id' , 'teamB_score' , 'start_date_time' , 'report_id'
    ];
}
