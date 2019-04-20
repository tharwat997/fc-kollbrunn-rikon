@extends('layouts.app')

@section('content')
    <section id="teamSection">
        @if(@isset($firstTeamUnformatted))
            <team team-name="First Team" :players-array="{{$firstTeamUnformatted}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorC))
            <team team-name="Junior C" :players-array="{{$juniorC}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorD))
            <team team-name="Junior D" :players-array="{{$juniorD}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorE))
            <team team-name="Junior E" :players-array="{{$juniorE}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorF))
            <team team-name="Junior F" :players-array="{{$juniorF}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($boardOfDirectors))
            <team :board-of-directors="true" team-name="Board of directors" :players-array="{{$boardOfDirectors}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @endif
    </section>
@endsection
