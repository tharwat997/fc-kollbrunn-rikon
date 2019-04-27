<?php

namespace App\Http\Controllers;

use App\Event;
use App\Message;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function submit (Request $request){
        $data = $request->all();

       if ($data['fax'] === null){

           $message = new Message;
           $message->sender_name = $data['name'];
           $message->sender_email = $data['email'];
           $message->sender_number = $data['mobileNumber'];
           $message->purpose_of_contact = $data['purposeOfContact'];

           if ($data['purposeOfContact'] === 2){

               $message->join_team = $data['teamSelected'];

           } else if( $data['purposeOfContact'] === 3){
               $message->join_event = $data['eventSelected'];
               $message->reason_of_joining_event = $data['joinEventSelection'] === 1 ? 'Participant' : 'Volunteer' ;
           }

           $message->message = $data['message'];
           $message->read = 0;
           $message->assigned_id = 1 ;

           $message->save();
       }
    }

    public function index(){
        $users = User::all();
        $messagesUnformatted = Message::all();
        $messages = [];


        foreach ($messagesUnformatted as $message){

            if ($message->purpose_of_contact === "1"){

                $message->purpose_of_contact = "Question";
            }

            if ($message->purpose_of_contact === "2"){

                $message->purpose_of_contact = "Join Team";
                $team = Team::find($message->join_team);
                $message->join_team = $team->name;
            }

            if ($message->purpose_of_contact === "3"){

                $message->purpose_of_contact = "Join Event";
                $eventId = (int) $message->join_event;

                $event = Event::find($eventId);

                $message->join_event = $event->title;
            }

            $assignedTo = User::find($message->assigned_id);
            $message->assigned_id = $assignedTo->name;
            array_push($messages, $message);
        }

        return view('admin.messages.messages', compact('messages', 'users'));
    }

    public function messageShow($id){
        $message = Message::find($id);
        $message->read = 0;
        $message->update();

        $users = User::all();

        if ($message->purpose_of_contact === "3"){
            $event = Event::find( (int) $message->join_event);
            $message->join_event = $event->title;
        }

        return view('admin.messages.message_detail_view', compact('message', 'users'));
    }

    public function messageUpdate(Request $request){

        if ($request->btnUpdate === "btnUpdate"){

            $message = Message::find($request->messageId);
            $message->assigned_id = $request->assignedTo;
            $message->update();
            return redirect()->back();

        } else if($request->btnDelete === "btnDelete"){
            $message = Message::find($request->messageId);
            $message->delete();
            return redirect()->route('messages');
        }
    }

    public function  messageUpdateAssignedUser(Request $request){

        $user = User::find($request->userAssigned);

        if ($request->subject === "events"){
            $user->assigned_message_subject = "join_event";
        } else if ($request->subject === "teams"){
            $user->assigned_message_subject = "join_team";
        } else if ($request->subject === "questions"){
            $user->assigned_message_subject = "questions";
        }

        $user->update();

        return redirect()->back();
    }
}
