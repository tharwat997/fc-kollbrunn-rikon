@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #manageEventsTable img{
            height: 65px;
            width: 65px;
        }
    </style>
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Players</span>
            <h4 class="page-title">Manage players</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-5">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage players</h6>
                </div>
                <div class="hidden">
                    @foreach($players as $player)
                        <form action="{{route('players_update')}}" method="post" id="form{{$player->id}}" enctype="multipart/form-data">
                            @csrf
                        </form>
                    @endforeach
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="">
                        <table id="manageEventsTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Player name</th>
                                <th>Player number</th>
                                <th>Player position</th>
                                <th>Player age</th>
                                <th>Current Image</th>
                                <th>Player Image</th>
                                <th>Teams</th>
                                <th>Goals</th>
                                <th>Yellow Cards</th>
                                <th>Red Cards</th>
                                <th>Assists</th>
                                <th>Date joined</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                @foreach($player->image as $image)
                                <tr>
                                    <td>
                                        <input type="text" form="form{{$player->id}}" name="name" required class="form-control" value="{{$player->name}}">
                                        <input type="hidden" form="form{{$player->id}}" name="playerId" required class="form-control" value="{{$player->id}}">
                                        <div class="d-none">{{$player->name}}</div>
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="playerNumber" required class="form-control" value="{{$player->playerNumber}}">
                                    </td>
                                    <td>
                                        <div>
                                            <select form="form{{$player->id}}" required class="form-control" name="playerPosition" >
                                                <option {{$player->playerPosition === "goalkeeper" ? 'selected' : ''}} value="goalkeeper">Goal Keeper</option>
                                                <option {{$player->playerPosition === "defender" ? 'selected' : ''}} value="defender">Defender</option>
                                                <option {{$player->playerPosition === "midfielder" ? 'selected' : ''}} value="midfielder">Midfielder</option>
                                                <option {{$player->playerPosition === "attacker" ? 'selected' : ''}} value="attacker">Attacker</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="playerAge" required class="form-control" value="{{$player->age}}">
                                    </td>
                                    <td>
                                       <div class="d-flex align-items-center justify-content-center">
                                           {{$image}}
                                       </div>
                                    </td>
                                    <td>
                                        <input type="file" form="form{{$player->id}}" name="image"  class="form-control">
                                    </td>
                                    <td>
                                        <div>
                                            <select form="form{{$player->id}}" required class="form-control" name="team_id" >
                                                @foreach($teams as $team)
                                                    <option {{$team->name === $player->team_id ? 'selected' : ''}} value="{{$team->id}}">{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="total_goals" required class="form-control" value="{{$player->total_goals}}">
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="yellow_cards" required class="form-control" value="{{$player->yellow_cards}}">
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="red_cards" required class="form-control" value="{{$player->red_cards}}">
                                    </td>
                                    <td>
                                        <input type="number" form="form{{$player->id}}" name="assists" required class="form-control" value="{{$player->assists}}">
                                    </td>
                                    <td>
                                        <input type="date" form="form{{$player->id}}" name="date_joined" required class="form-control" value="{{$player->date_joined}}">
                                    </td>
                                    <td>
                                        <div class="d-flex ">
                                            <div class="mr-1">
                                                <button type="submit" form="form{{$player->id}}" name="updateBtn" value="updateBtn" class="btn btn-primary btn-block">Update</button>
                                            </div>
                                            <div>
                                                <button type="submit" form="form{{$player->id}}" name="deleteBtn" value="deleteBtn" class="btn btn-danger btn-block">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Search players</h6>
                </div>
                <div class="card-body">
                        <table id="searchPlayersTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Player name</th>
                                <th>Player number</th>
                                <th>Player position</th>
                                <th>Player age</th>
                                <th>Player Image</th>
                                <th>Teams</th>
                                <th>Goals</th>
                                <th>Yellow Cards</th>
                                <th>Red Cards</th>
                                <th>Assists</th>
                                <th>Date joined</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                @foreach($player->image as $image)
                                    <tr>
                                        <td>
                                           <div>{{$player->name}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->playerNumber}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->playerPosition}}</div>
                                        </td>
                                        <td>
                                            {{$player->age}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img src="{{$image->getUrl('thumb')}}" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            {{$player->team_id}}
                                        </td>
                                        <td>
                                            <div>{{$player->total_goals}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->yellow_cards}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->red_cards}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->assists}}</div>
                                        </td>
                                        <td>
                                            <div>{{$player->date_joined}}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    {
                        "className": "dt-center"
                    }
                ],
                "scrollX": true
            });
            $('#searchPlayersTable').DataTable({
                "columnDefs": [
                    {
                        "className": "dt-center"
                    }
                ],
                "scrollX": true,
                "autoWidth": false
            });

        } );
    </script>
@endsection
