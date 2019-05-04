@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .arrowBack{
            font-size: 20px;
        }
    </style>
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-2 pt-4  d-flex flex-column">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-2">
            <span class="text-uppercase page-subtitle">Matches' events</span>
            <h4 class="page-title">Manage matches' events</h4>
        </div>
        <div class="breadcrumb">
            <a class="breadcrumb-item" href="{{route('matches')}}">Matches</a>
            <a class="breadcrumb-item" href="{{\Illuminate\Support\Facades\Request::url()}}">Match {{$match->id}} events</a>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Select event</h6>
                </div>
                <div class="card-body">

                    <table id="searchMatchesTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Event title</th>
                            <th>Minute of event</th>
                            <th>Player home</th>
                            <th>Player away</th>
                            <th>Goal</th>
                            <th>Assist</th>
                            <th>Yellow card</th>
                            <th>Red card</th>
                            <th>Injury</th>
                            <th>Substitution</th>
                            <th>Blank</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->title}}</td>
                                <td>{{$event->minute_of_event}}</td>
                                @if($event->player_idHome !=null)
                                    <td>{{$event->player_idHome}}</td>
                                    @else
                                    <td>null</td>
                                @endif
                                @if($event->playerNameAway !=null)
                                    <td>{{$event->playerNameAway}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->goal !=null)
                                    <td>{{$event->goal}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->assist !=null)
                                    <td>{{$event->assist}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->yellow_card !=null)
                                    <td>{{$event->yellow_card}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->red_card !=null)
                                    <td>{{$event->red_card}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->injury !=null)
                                    <td>{{$event->injury}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->substitute !=null)
                                    <td>{{$event->substitute}}</td>
                                @else
                                    <td>null</td>
                                @endif
                                @if($event->blank_event !=null)
                                <td>{{$event->blank_event}}</td>
                                @else
                                <td>null</td>
                                @endif
                                <td>{{$event->created_at}}</td>
                                <td>
                                    <div>
                                        <a href="{{route('match_event_manage', ['matchId' => $event->match_id, 'eventId' => $event->id])}}" class="btn btn-primary btn-block" style="color: white;">Edit event</a>
                                        <a href="{{route('match_event_delete', ['matchId' => $event->match_id, 'eventId' => $event->id])}}" class="btn btn-danger btn-block" style="color: white;">Delete event</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

        } );
    </script>
@endsection
