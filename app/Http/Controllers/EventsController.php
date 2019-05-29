<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function index(){
        $eventsNumber = Event::all()->count();
        $events = [];

        for ($x = 0; $x <= $eventsNumber; $x++) {
            $event = Event::find($x);
            if ($event != null){
                $eventImage = $event->getMedia('eventsImages');
                $event->image = $eventImage;
                array_push($events, $event);
            }
        }

        return view('events' , compact('events'));
    }

    public function eventsCreate(){
        return view('admin.events.create_event');
    }

    public function store(Request $request){

        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            "eventImage" => "required|image|mimes:jpeg,png,jpg|dimensions:ratio=1/1,min_width=325,min_height=325",
        ]);

        if($validator->fails()){
            return redirect()->back()->with('message', 'Image needs to be 1:1 aspect ratio. Example: 325x325')->withInput();
        } else {
            if ($request->eventImage === null){
                $event = new Event([
                    'title' => $request->eventTitle,
                    'description' => $request->eventDescription,
                    'start_date' => $request->startDate,
                    'location' => $request->eventLocation,
                    'image' => $request->eventImage,
                    'creator_id' => $user->id
                ]);
                $event->save();
            } else {
                $event = new Event([
                    'title' => $request->eventTitle,
                    'description' => $request->eventDescription,
                    'start_date' => $request->startDate,
                    'location' => $request->eventLocation,
                    'image' => $request->eventImage,
                    'creator_id' => $user->id
                ]);
                $event->save();
                $event->addMedia($request->eventImage)
                    ->withResponsiveImages()
                    ->toMediaCollection('eventsImages');
            }

            return redirect()->back();
        }

    }

    public function eventsManage(){
        $events = Event::all();
        $newEvents = [];

        foreach($events as $event){
            $eventImage = $event->getMedia('eventsImages');
            $event->image = $eventImage;
            $event->creator_id = User::find($event->creator_id)->name;
            array_push($newEvents, $event);
        }

        return view('admin.events.manage_events' , ['events' => $newEvents]);
    }

    public function update(Request $request){

        if ($request->btnUpdate != null){

            if ($request->image != null){

                $validator = Validator::make($request->all(),[
                    "image" => "required|image|mimes:jpeg,png,jpg|dimensions:ratio=1/1,min_width=325,min_height=325",
                ]);

                if($validator->fails()){
                    return redirect()->back()->with('message', 'Image needs to be 1:1 aspect ratio. Example: 325x325');
                } else {

                    $event = Event::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->location = $request->location;
                    $event->start_date = $request->start_date;
                    $event->image = $request->image;
                    $event->creator_id = $event->creator_id;
                    $event->update();

                    $event->addMedia($request->image)
                        ->withResponsiveImages()
                        ->toMediaCollection('eventsImages');

                    return redirect()->back();
                }
            } else {

                $event = Event::find($request->eventId);
                $event->title = $request->title;
                $event->description = $request->description;
                $event->location = $request->location;
                $event->start_date = $request->start_date;
                $event->image =  $event->image;
                $event->creator_id = $event->creator_id;
                $event->update();

                return redirect()->back();
            }

        } else if ($request->btnDelete != null) {
            $event = Event::find($request->eventId);
            $event->delete();
            DB::table('events')->where('id', '=', $request->eventId)->delete();
            return redirect()->route('events_manage');
        }
    }

    public function show($id){
        $event = Event::find($id);
        $user = User::find($event->creator_id);
        $eventCreatorName = $user->name;
        $event->image = $event->getMedia('eventsImages');
        return view('admin.events.manage_events_detail', compact('event', 'eventCreatorName'));
    }

    public function eventsAjax(){

        $eventsUnformatted = Event::orderBy('start_date', 'desc')->take(5)->get();
        $formattedEvents = [];

        foreach ($eventsUnformatted as $event){
            $event = Event::find($event->id);
            $event->image =  $event->getMedia('eventsImages');

            array_push($formattedEvents, $event);
        }

        return response()->json($formattedEvents);
    }
}
