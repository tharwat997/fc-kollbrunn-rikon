<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\ContactUsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index(){
        return view('contact_us');
    }

    public function eventsAjax(){
        $events = Event::all();
        return response()->json($events);
    }
}
