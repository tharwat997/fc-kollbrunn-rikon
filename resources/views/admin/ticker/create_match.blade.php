@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Match</span>
            <h4 class="page-title">Add match</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add match to matches</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('match_store')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Match type</span>
                            </div>
                            <select name="matchType" class="form-control" required id="">
                                <option value="Liga">Liga</option>
                                <option value="Cup">Cup</option>
                                <option value="Freundschaftsspiel">Freundschaftsspiel</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Match title</span>
                            </div>
                            <input type="text"  name="title" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2" >
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Home team</span>
                            </div>
                            <select name="homeTeam" class="form-control" required>
                                @foreach($teams as $team)
                                    <option value="{{$team->name}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Home team score</span>
                            </div>
                            <input type="number" required value="0" name="homeTeamScore" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Away team</span>
                            </div>
                            <input type="text" required name="awayTeam" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Away team score</span>
                            </div>
                            <input type="number" required value="0" name="awayTeamScore" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Start date and time</span>
                            </div>
                            <input type="datetime-local" required value="0" name="startDateTime" class="form-control">
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Assign reporter</span>
                                </div>
                                <select name="reportId" class="form-control" required>
                                    @foreach($reporters as $reporter)
                                        <option value="{{$reporter->id}}">{{$reporter->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="input-group d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
