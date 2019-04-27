<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

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
