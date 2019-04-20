@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Players</span>
            <h4 class="page-title">Add player</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add player to players</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('players_store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Player name</span>
                            </div>
                            <input type="text" name="playerName" class="form-control" required  aria-label="" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Player number</span>
                            </div>
                            <input type="number"  name="playerNumber" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Player position</span>
                            </div>
                            <select required class="form-control" name="playerPosition" >
                                <option value="goalkeeper">Goal Keeper</option>
                                <option value="defender">Defender</option>
                                <option value="midfielder">Midfielder</option>
                                <option value="attacker">Attacker</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Team</span>
                            </div>
                            <select required class="form-control" name="team" >
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Player Age</span>
                            </div>
                            <input type="number"  name="playerAge" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Total goals</span>
                            </div>
                            <input type="number"  name="totalGoals" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Yellow cards</span>
                            </div>
                            <input type="number"  name="yellowCards" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Red cards</span>
                            </div>
                            <input type="number"  name="redCards" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Assists</span>
                            </div>
                            <input type="number"  name="assists" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Date joined</span>
                            </div>
                            <input type="date" name="dateJoined" class="form-control" required aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Image</span>
                            </div>
                            <input type="file"  name="image" class="form-control" required  aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>

                        <div class="input-group d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
