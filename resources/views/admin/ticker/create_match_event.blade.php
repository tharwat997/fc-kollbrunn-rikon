@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">
    <style type="text/css">
        .ql-toolbar.ql-snow:first-child{
            display: none !important;
        }
    </style>
@endsection
@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{$match->type_name}} events creation</span>
            <h3 class="page-title">Add event</h3>
        </div>
    </div>
    <form id="eventManagementForm" action="{{route('match_event_store')}}" method="POST">
        <div class="row d-flex">
            @csrf
            <div class="col-lg-9 col-md-12" style="max-width: unset !important;">

                <div class="card card-small mb-3">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form class="add-new-post">
                            <div class="card-header">
                                <h6>Event Title</h6>
                                <input class="form-control" placeholder="Goal..." required name="title" type="text" value="">
                            </div>
                            <div class="card-header">
                                <h6>Event Description</h6>
                                <textarea class="form-control" name="description" required rows="20"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12">

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Event Details</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-3 pb-2">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Event Type</span>
                                    </div>
                                    <select name="eventType" required class="form-control">
                                        <option value="goal">Goal</option>
                                        <option value="assist">Assist</option>
                                        <option value="yellowCard">Yellow card</option>
                                        <option value="redCard">Red card</option>
                                        <option value="injury">Injury</option>
                                        <option value="substitution">Substitution</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3 d-flex flex-column">
                                    <strong class="text-muted d-block mb-2">Player</strong>
                                    <div>
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <input type="checkbox" required checked id="customToggle1" name="homePlayer" class="custom-control-input">
                                            <label class="custom-control-label" for="customToggle1">Home player</label>
                                        </div>
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <input type="checkbox" id="customToggle2" name="awayPlayer" class="custom-control-input">
                                            <label class="custom-control-label" for="customToggle2">Away player</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3" id="homePlayerContainer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Player name</span>
                                    </div>
                                    <select name="homePlayerName" required class="form-control">
                                        @foreach($players as $player)
                                            <option value="{{$player->id}}">{{$player->name}} {{$player->playerNumber}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-3  d-none" id="awayPlayerContainer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Player name</span>
                                    </div>
                                    <input type="text"  class="form-control" name="awayPlayerName"  aria-label="creator" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Event Minute</span>
                                    </div>
                                    <input type="number" required maxlength="3" placeholder="0" max="200" class="form-control" name="eventMinute" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-primary btn-block">Post</button>
                                </div>

                                <input type="hidden" name="matchId" value="{{$match->id}}">
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>
    <script src="{{asset('admin_assets/scripts/app/app-blog-new-post.1.1.0.min.js')}}"></script>
    <script>
        $('#customToggle1').change(function () {
            if( $('#customToggle1').is(':checked') ){
                $('#homePlayerContainer').removeClass('d-none');
                $('#awayPlayerContainer').addClass('d-none');
                $('#customToggle2').prop('checked', false);

                $('#customToggle1').prop('required', true);
                $('#customToggle2').prop('required', false);

                $('#homePlayerContainer > select').prop('required', true);
                $('#awayPlayerContainer > input').prop('required', false);
            } else {

                $('#customToggle2').prop('checked', true);
                $('#homePlayerContainer').addClass('d-none');
                $('#awayPlayerContainer').removeClass('d-none');
                $('#customToggle1').prop('required', false);
                $('#customToggle2').prop('required', true);

                $('#homePlayerContainer > select').prop('required', false);
                $('#awayPlayerContainer > input').prop('required', true);
            }
        })
        $('#customToggle2').change(function () {
            if( $('#customToggle2').is(':checked') ){
                $('#awayPlayerContainer').removeClass('d-none');
                $('#customToggle1').prop('checked', false);
                $('#homePlayerContainer').addClass('d-none');

                $('#customToggle2').prop('required', true);
                $('#customToggle1').prop('required', false);

                $('#homePlayerContainer > select').prop('required', false);
                $('#awayPlayerContainer > input').prop('required', true);
            } else {
                $('#customToggle1').prop('checked', true);
                $('#awayPlayerContainer').addClass('d-none');
                $('#homePlayerContainer').removeClass('d-none');
                $('#customToggle1').prop('required', true);
                $('#customToggle2').prop('required', false);

                $('#homePlayerContainer > select').prop('required', true);
                $('#awayPlayerContainer > input').prop('required', false);
            }
        })
    </script>
@endsection

