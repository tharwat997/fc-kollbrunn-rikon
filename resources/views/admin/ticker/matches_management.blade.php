@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Matches</span>
            <h4 class="page-title">Manage matches</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-5">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Search matches</h6>
                </div>
                <div class="hidden">
                    @foreach($matches as $match)
                        <form action="{{route('match_update')}}" method="post" id="form{{$match->id}}">
                            @csrf
                        </form>
                    @endforeach
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <table id="manageEventsTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Match type</th>
                            <th>Match title</th>
                            <th>Home team</th>
                            <th>Home team score</th>
                            <th>Away team</th>
                            <th>Away team score</th>
                            <th>Start date and time</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                <th>Reporter</th>
                            @endif
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td>
                                    <select name="matchType" form="form{{$match->id}}" class="form-control" required id="">
                                        <option {{$match->match_type === 'league' ? 'selected' : ''}} value="league">League</option>
                                        <option {{$match->match_type === 'cup' ? 'selected' : ''}} value="cup">Cup</option>
                                        <option {{$match->match_type === 'friendly' ? 'selected' : ''}} value="friendly">Friendly</option>
                                    </select>
                                    <input type="hidden" form="form{{$match->id}}" name="matchId" required class="form-control" value="{{$match->id}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$match->id}}" name="matchTitle" required class="form-control" value="{{$match->type_name}}">
                                </td>
                                <td>
                                    <select name="homeTeam" class="form-control" required form="form{{$match->id}}">
                                        @foreach($teams as $team)
                                            <option {{$team->name === $match->teamA_name ? 'selected' : ''}} value="{{$team->name}}">{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" form="form{{$match->id}}" name="homeTeamScore" required class="form-control" value="{{$match->teamA_score}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$match->id}}" name="awayTeam" required class="form-control" value="{{$match->teamB_name}}">
                                </td>
                                <td>
                                    <input type="number" form="form{{$match->id}}" name="awayTeamScore" required class="form-control" value="{{$match->teamB_score}}">
                                </td>
                                <td>
                                    <input type="datetime-local" form="form{{$match->id}}" name="start_date_time" required class="form-control" value="{{$match->start_date_time}}">
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                   <td>
                                       <select name="reportId" class="form-control" required form="form{{$match->id}}">
                                           @foreach($reporters as $reporter)
                                               <option {{$reporter->id === $match->reporter_id ? 'selected': ''}} value="{{$reporter->id}}">{{$reporter->name}}</option>
                                           @endforeach
                                       </select>
                                   </td>
                                @endif
                                <td>
                                    <div class="d-flex ">
                                        <div class="mr-1">
                                            <button type="submit" form="form{{$match->id}}" name="updateBtn" value="updateBtn" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                        <div>
                                            <button type="submit" form="form{{$match->id}}" name="deleteBtn" value="deleteBtn" class="btn btn-danger btn-block">Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage matches</h6>
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
            $('#manageEventsTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });
            $('#searchMatchesTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });

        } );
    </script>
@endsection
