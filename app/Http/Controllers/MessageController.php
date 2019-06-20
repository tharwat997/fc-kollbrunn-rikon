<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\ContactUsMessage;
use App\Message;
use App\Post;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public $users = [];

    public function submit (Request $request){
        $data = $request->all();

       if ($data['fax'] === null){
           $adminUsers = DB::table('role_user')->where('role_id', '=', 1)->get();

           $message = new Message;
           $message->sender_name = $data['name'];
           $message->sender_email = $data['email'];
           $message->sender_number = $data['mobileNumber'];
           $message->purpose_of_contact = $data['purposeOfContact'];
           $message->message = $data['message'];
           $message->read = 0;
           $message->assigned_id = 1 ;

           if ($data['purposeOfContact'] === 3){
               $message->join_team = $data['teamSelected'];
               $team = Team::find($data['teamSelected']);
               $teamName = $team->name;
               $this->users  = User::where('assigned_message_subject', '=', 'join_team')->get();

               foreach ($this->users as $user){

                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Join team',
                       'team' => $teamName,
                       'message' => $message->message,
                   ]);

                   Mail::to($user->email)->send(new ContactUsMessage($data));
               }

               foreach ($adminUsers as $admin){
                   $adminUser = User::find($admin->user_id);
                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Join team',
                       'team' => $teamName,
                       'message' => $message->message,
                   ]);

                   Mail::to($adminUser->email)->send(new ContactUsMessage($data));
               }

           } else if( $data['purposeOfContact'] === 4){
               $message->join_event = $data['eventSelected'];
               $message->reason_of_joining_event = $data['joinEventSelection'] === 1 ? 'Teilnehmer' : 'Helfer' ;

               $event = Event::find($data['eventSelected']);
               $eventName = $event->name;

               $this->users = User::where('assigned_message_subject', '=', 'join_event')->get();

               foreach ($this->users as $user){

                   $data2 = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Join event',
                       'event' => $eventName,
                       'reason_of_joining_event' =>  $data['joinEventSelection'] === 1 ? 'Teilnehmer' : 'Helfer' ,
                       'message' => $message->message,
                   ]);

                   Mail::to($user->email)->send(new ContactUsMessage($data2));
               }

               foreach ($adminUsers as $admin){
                   $adminUser = User::find($admin->user_id);
                   $data2 = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Join event',
                       'event' => $eventName,
                       'reason_of_joining_event' =>  $data['joinEventSelection'] === 1 ? 'Teilnehmer' : 'Helfer' ,
                       'message' => $message->message,
                   ]);

                   Mail::to($adminUser->email)->send(new ContactUsMessage($data2));
               }

           } else if ($data['purposeOfContact'] === 2){

               $this->users = User::where('assigned_message_subject', '=', 'questions')->get();

               foreach ($this->users as $user){

                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Question',
                       'message' => $message->message,
                   ]);

                   Mail::to($user->email)->send(new ContactUsMessage($data));
               }

               foreach ($adminUsers as $admin){
                   $adminUser = User::find($admin->user_id);
                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Question',
                       'message' => $message->message,
                   ]);

                   Mail::to($adminUser->email)->send(new ContactUsMessage($data));
               }

           } else if ($data['purposeOfContact'] === 1){

               $this->users = User::where('assigned_message_subject', '=', 'questions')->get();

               foreach ($this->users as $user){

                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Question',
                       'message' => $message->message,
                   ]);

                   Mail::to($user->email)->send(new ContactUsMessage($data));
               }

               foreach ($adminUsers as $admin){
                   $adminUser = User::find($admin->user_id);
                   $data = ([
                       'sender_name' =>$message->sender_name,
                       'sender_email' => $message->sender_email,
                       'sender_number' =>  $message->sender_number,
                       'purpose_of_contact' =>  'Question',
                       'message' => $message->message,
                   ]);

                   Mail::to($adminUser->email)->send(new ContactUsMessage($data));
               }

           }

           $message->save();

       } else {
           return redirect()->back();
       }
    }

    public function index(){
        $usersUnformatted = User::all();
        $messagesUnformatted = Message::all();
        $messages = [];
        $users = [];


        foreach ($messagesUnformatted as $message){

            if ($message->purpose_of_contact === "1"){

                $message->purpose_of_contact = "Question";
            }

            if ($message->purpose_of_contact === "2"){

                $message->purpose_of_contact = "Question";
            }

            if ($message->purpose_of_contact === "3"){

                $message->purpose_of_contact = "Join Team";
                $team = Team::find($message->join_team);
                $message->join_team = $team->name;
            }

            if ($message->purpose_of_contact === "4"){

                $message->purpose_of_contact = "Join Event";
                $eventId = (int) $message->join_event;

                $event = Event::find($eventId);

                $message->join_event = $event->title;
            }

            $assignedTo = User::find($message->assigned_id);
            $message->assigned_id = $assignedTo->name;
            array_push($messages, $message);
        }

        foreach($usersUnformatted as $user){
            $role = DB::table('role_user')->where('user_id', '=', $user->id)->first();

            $userAdjusted = ([
               'id' => $user->id,
               'name' => $user->name,
               'email' => $user->email,
               'password' => $user->password,
               'assigned_message_subject' => $user->assigned_message_subject,
               'role' => $role->role_id == 1 ? 'Admin' : 'Reporter',
            ]);

            array_push($users, $userAdjusted);
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

        $user = User::find($request->id);

        if ($request->subject === "events"){
            $user->assigned_message_subject = "join_event";
        } else if ($request->subject === "teams"){
            $user->assigned_message_subject = "join_team";
        } else if ($request->subject === "questions"){
            $user->assigned_message_subject = "questions";
        } else if ($request->subject = "null"){
            $user->assigned_message_subject = null;
        }

        $user->update();

        return redirect()->back();
    }
}
