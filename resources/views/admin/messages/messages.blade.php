@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Messages</span>
            <h4 class="page-title">Messages</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">

            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Select message</h6>
                </div>
                <div class="card-body">

                    <table id="searchMatchesTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Purpose Of Contact</th>
                            <th>Join team</th>
                            <th>Join event</th>
                            <th>Join event as</th>
                            <th>Read</th>
                           @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                <th>Assigned To</th>
                            @endif
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin')
                            || \Illuminate\Support\Facades\Auth::user()->assigned_message_subject === "join_team")
                                @if($message->join_team != null)
                                <tr>
                                    <td>{{$message->sender_email}}</td>
                                    <td>{{$message->sender_name}}</td>
                                    <td>{{$message->sender_number}}</td>
                                    <td>{{$message->purpose_of_contact}}</td>
                                    <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                    <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                    <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                    <td>{{$message->read === 0 ? 'read' : 'unread'}}</td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                        <td>{{$message->assigned_id}}</td>
                                    @endif
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div>
                                                <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif

                            @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('admin')
                                        || \Illuminate\Support\Facades\Auth::user()->assigned_message_subject === "join_event")
                                @if($message->join_event != null)
                                    <tr>
                                        <td>{{$message->sender_email}}</td>
                                        <td>{{$message->sender_name}}</td>
                                        <td>{{$message->sender_number}}</td>
                                        <td>{{$message->purpose_of_contact}}</td>
                                        <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                        <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                        <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                        <td>{{$message->read === 0 ? 'read' : 'unread'}}</td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                            <td>{{$message->assigned_id}}</td>
                                        @endif
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('admin')
                                    || \Illuminate\Support\Facades\Auth::user()->assigned_message_subject === "questions")
                                @if($message->join_event === null && $message->join_team === null)
                                    <tr>
                                        <td>{{$message->sender_email}}</td>
                                        <td>{{$message->sender_name}}</td>
                                        <td>{{$message->sender_number}}</td>
                                        <td>{{$message->purpose_of_contact}}</td>
                                        <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                        <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                        <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                        <td>{{$message->read === 0 ? 'read' : 'unread'}}</td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                            <td>{{$message->assigned_id}}</td>
                                        @endif
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                <div class="card  mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Assign Message Subject</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-none">
                            <form action="{{route('message_update_assigned_user')}}" id="formQuestions" method="post">
                                @csrf
                            </form>
                            <form action="{{route('message_update_assigned_user')}}" id="formEvents" method="post">
                                @csrf
                            </form>
                            <form action="{{route('message_update_assigned_user')}}" id="formTeam" method="post">
                                @csrf
                            </form>
                        </div>
                        <table id="searchMatchesTable2" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Questions</td>
                                <td>
                                    <select class="form-control" form="formQuestions" name="userAssigned" required>
                                        @foreach($users as $user)
                                            <option {{$user->assigned_message_subject == "questions" ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input form="formQuestions" type="hidden" name="subject" value="questions">
                                    <button form="formQuestions" type="submit" class="btn btn-primary">Save</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Teams</td>
                                <td>
                                    <select class="form-control" form="formEvents" name="userAssigned" required>
                                        @foreach($users as $user)
                                            <option {{$user->assigned_message_subject == "questions" ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input form="formTeam" type="hidden" name="subject" value="teams">
                                    <button form="formTeam" type="submit" class="btn btn-primary">Save</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Events</td>
                                <td>
                                    <select class="form-control" form="formEvents" name="userAssigned" required>
                                        @foreach($users as $user)
                                            <option {{$user->assigned_message_subject == "questions" ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input form="formEvents"  type="hidden" name="subject" value="events">
                                    <button form="formEvents" type="submit" class="btn btn-primary">Save</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#searchMatchesTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });

            $('#searchMatchesTable2').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });

        } );
    </script>
@endsection
