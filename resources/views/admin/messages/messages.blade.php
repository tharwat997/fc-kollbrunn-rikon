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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)

                            @if($message->join_team != null && \Illuminate\Support\Facades\Auth::user()->hasRole('reporter'))
                                    <tr>
                                        <td>{{$message->sender_email}}</td>
                                        <td>{{$message->sender_name}}</td>
                                        <td>{{$message->sender_number}}</td>
                                        <td>{{$message->purpose_of_contact}}</td>
                                        <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                        <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                        <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                            @elseif($message->join_event != null && \Illuminate\Support\Facades\Auth::user()->hasRole('reporter'))
                                    <tr>
                                        <td>{{$message->sender_email}}</td>
                                        <td>{{$message->sender_name}}</td>
                                        <td>{{$message->sender_number}}</td>
                                        <td>{{$message->purpose_of_contact}}</td>
                                        <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                        <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                        <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                            @elseif($message->join_event === null && $message->join_team === null && \Illuminate\Support\Facades\Auth::user()->hasRole('reporter'))
                                    <tr>
                                        <td>{{$message->sender_email}}</td>
                                        <td>{{$message->sender_name}}</td>
                                        <td>{{$message->sender_number}}</td>
                                        <td>{{$message->purpose_of_contact}}</td>
                                        <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                        <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                        <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @elseif (\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                <tr>
                                    <td>{{$message->sender_email}}</td>
                                    <td>{{$message->sender_name}}</td>
                                    <td>{{$message->sender_number}}</td>
                                    <td>{{$message->purpose_of_contact}}</td>
                                    <td>{{$message->join_team === null ? 'Null' : $message->join_team}}</td>
                                    <td>{{$message->join_event === null ? 'Null' : $message->join_event}}</td>
                                    <td>{{$message->reason_of_joining_event === null ? 'Null' : $message->reason_of_joining_event}}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div>
                                                <a href="{{route('message_view', ['id' => $message->id])}}" class="btn btn-block btn-primary">View</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                            @foreach($users as $user)
                                <form method="POST" id="messageUpdateUserForm{{$user['id']}}" action="{{route('message_update_assigned_user')}}">
                                    @csrf
                                </form>
                            @endforeach
                        </div>
                        <table id="searchMatchesTable2" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Assigned Message Subject</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{$user['role']}}</td>
                                        <td>
                                            <select form="messageUpdateUserForm{{$user['id']}}" name="subject" class="form-control">
                                                <option {{$user['assigned_message_subject'] === "questions"? 'selected' : ''}} value="questions">Questions</option>
                                                <option {{$user['assigned_message_subject'] === "join_event"? 'selected' : ''}} value="events">Join event</option>
                                                <option {{$user['assigned_message_subject'] === "join_team"? 'selected' : ''}} value="teams">Join Team</option>
                                                <option {{$user['assigned_message_subject'] === null ? 'selected' : ''}} value="null">Null</option>
                                            </select>
                                            <input form="messageUpdateUserForm{{$user['id']}}"  type="hidden" name="id" value="{{$user['id']}}">
                                        </td>
                                        <td>
                                            <button form="messageUpdateUserForm{{$user['id']}}" type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>
                                @endforeach
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
