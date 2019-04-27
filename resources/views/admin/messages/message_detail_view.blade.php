@extends('admin.layouts.app')

@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Message from {{$message->name}}</span>
            <h3 class="page-title">View message details</h3>
        </div>
    </div>
    <form action="{{route('message_update')}}" method="post">
        @csrf
        <div class="row d-flex">
            <div class=" {{auth()->user()->hasRole('admin') ? 'col-lg-9 ' : 'col-lg-12'}} col-md-12" style="max-width: unset !important;">
                <div class="card card-small mb-3">
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Sender Email:</strong> {{$message->sender_email}}
                        </div>
                        <div  class="mb-2">
                            <strong>Sender Name:</strong> {{$message->sender_name}}
                        </div>
                        <div  class="mb-2">
                            <strong>Sender Number:</strong> {{$message->sender_number}}
                        </div>
                        @if($message->purpose_of_contact === "1")
                            <div  class="mb-2">
                                <strong>Purpose of Contact:</strong> Question
                            </div>
                        @elseif ($message->purpose_of_contact === "2")
                            <div  class="mb-2">
                                <strong>Purpose of Contact:</strong> Join Team
                            </div>
                            @if($message->join_team === "1")
                                <div  class="mb-2">
                                    <strong>Team:</strong> First team
                                </div>
                                @elseif($message->join_team === "2")
                                <div  class="mb-2">
                                    <strong>Team:</strong> Junior C
                                </div>
                                @elseif($message->join_team === "3")
                                <div  class="mb-2">
                                    <strong>Team:</strong> Junior D
                                </div>

                                @elseif($message->join_team === "4")
                                <div  class="mb-2">
                                    <strong>Team:</strong> Junior E
                                </div>
                                @elseif($message->join_team === "5")
                                <div  class="mb-2">
                                    <strong>Team:</strong> Junior F
                                </div>
                            @endif
                        @elseif ($message->purpose_of_contact === "3")
                            <div  class="mb-2">
                                <strong>Purpose of Contact:</strong> Join event
                            </div>
                            <div  class="mb-2">
                               <strong> Event:</strong> {{$message->join_event}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card card-small mb-3">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form class="add-new-post">
                            <div class="card-header">
                                <h6>Message</h6>
                                <div>
                                    {{$message->message}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
            <div class="col-lg-3 col-md-12">


                    <div class="card card-small mb-3">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Message Details</h6>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-3 pb-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Assigned to</span>
                                        </div>
                                        <select name="assignedTo" required class="form-control">
                                            @foreach($users as $user)
                                                <option {{$message->assigned_id === $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="messageId" value="{{$message->id}}">
                                </li>
                            </ul>
                        </div>
                    </div>

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Actions</h6>
                    </div>
                    <div class="card-body p-0">
                           <div class="d-flex flex-column align-items-center justify-content-center p-3">
                               <button type="submit"  value="btnUpdate" name="btnUpdate" class="btn btn-block mb-2 btn-primary">
                                   <i class="material-icons">update</i>Update</button>
                               <button type="submit"  value="btnDelete" name="btnDelete" class="btn btn-block  btn-danger mr-auto">
                                   <i class="material-icons md-24">delete</i> Delete</button>
                           </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
@endsection

