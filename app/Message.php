<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_name', 'sender_email', 'sender_number', 'purpose_of_contact', 'join_team', 'join_event',
        'reason_of_joining_event', 'message', 'read', 'assigned_id',
    ];
}
