<?php

namespace App\Http\Controllers;

use App\Agenda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AgendaController extends Controller
{
    public function index(){
        return view('agenda');
    }

    public function store(Request $request){

        if ($request->startDateTime > $request->endDateTime) {
            Session::flash('message', 'Start date and time must be before end date and time');
            return redirect()->back()->withInput();
        }

        $filtered = null;

        if ($request->recursiveOn == 1){
            $period = CarbonPeriod::create($request->startDateTime, $request->endDateTime);
            $dates = $period->toArray();
            $filtered = array_filter($dates, function($date) use ($request){
                return $date->dayOfWeek == $request->dayOfWeek;
            });

            foreach ($filtered as $date){
                $dateAfterHour = $date->copy();
                $dateAfterHour->addHours($request->durationOfEvent);

                Agenda::create([
                    'title' => $request->get('event-title'),
                    'start_date'=> $date,
                    'end_date'=> $dateAfterHour,
                ]);
            }

        } else{
            $agenda_event = new Agenda([
                'title' => $request->get('event-title'),
                'start_date'=> $request->get('startDateTime'),
                'end_date'=> $request->get('endDateTime')
            ]);

            $agenda_event->save();
        }

        return redirect()->back();

    }

    public function delete(){

    }

    public function update(Request $request){

        if ($request->action === 'update'){

            if ($request->start_date > $request->end_date) {
                Session::flash('message', 'Start date and time must be before end date and time');
                return redirect()->back()->withInput();
            } else {
                $event = Agenda::find($request->eventId);
                $event->title = $request->title;
                $event->start_date = $request->start_date;
                $event->end_date = $request->end_date;
                $event->update();
                return redirect()->back();
            }

        } else if ($request->action === 'delete') {
            $event = Agenda::find($request->eventId);
            $event->delete();
            return redirect()->back();
        }
    }

    public function agendaEventsCreate(){
        return view('admin.agenda.create_agenda');
    }

    public function agendaEventsManage(){
        $agendaEventsUnformatted= Agenda::all();
        $agendaEvents = [];

        foreach ($agendaEventsUnformatted as $event){
            $event->start_date = date("Y-m-d\TH:i:s", strtotime($event->start_date));
            $event->end_date = date("Y-m-d\TH:i:s", strtotime($event->end_date));
            array_push($agendaEvents , $event);
        }
        return view('admin.agenda.manage_agenda', compact('agendaEvents'));
    }

    public function agendaEvents(){
        $agendaEvents = Agenda::all();
        return response()->json($agendaEvents);
    }
}
