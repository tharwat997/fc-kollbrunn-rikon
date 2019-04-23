@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Matches' events</span>
            <h4 class="page-title">Manage matches' events</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Select match</h6>
                </div>
                <div class="card-body">

                    <table id="searchMatchesTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Match type</th>
                            <th>Match title</th>
                            <th>Home team</th>
                            <th>Home team score</th>
                            <th>Away team</th>
                            <th>Away team score</th>
                            <th>Start date and time</th>
                            <th>Reporter</th>
                            <th>Status</th>
                            <th>Match Events</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td>{{$match->match_type}}</td>
                                <td>{{$match->type_name}}</td>
                                <td>{{$match->teamA_name}}</td>
                                <td>{{$match->teamA_score}}</td>
                                <td>{{$match->teamB_name}}</td>
                                <td>{{$match->teamB_score}}</td>
                                <td>{{$match->start_date_time}}</td>
                                <td>
                                    @foreach($reporters as $reporter)
                                        @if($reporter->id === $match->reporter_id )
                                            <div>{{$reporter->name}}</div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($match->completed === 1)
                                        <div>Completed</div>
                                    @elseif($match->completed === 0)
                                        <div>Ongoing</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div>
                                            <form action="{{route('match_event_create', ['id' => $match->id])}}" method="get">
                                                <button {{$match->completed === 1 ? 'disabled' : ''}} type="submit" class="btn btn-block btn-primary">Create Event</button>
                                            </form>
                                        </div>
                                        <div class="mt-2">
                                            <form action="{{route('matches_events', ['id' => $match->id])}}" method="get">
                                                <button type="submit" class="btn btn-block btn-primary">Manage Events</button>
                                            </form>
                                        </div>
                                        <div class="mt-2">
                                            <form action="{{route('match_end', ['id' => $match->id])}}" method="post">
                                                @csrf
                                                <button {{$match->completed === 1 ? 'disabled' : ''}} type="submit" class="btn btn-success btn-block">End Match</button>
                                            </form>
                                        </div>
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
