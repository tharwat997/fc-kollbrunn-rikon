@extends('layouts.app')

@section('content')
    <section id="teamSection">
        @if(@isset($firstTeamUnformatted))
            <team team-name="Aktive" :players-array="{{$firstTeamUnformatted}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorC))
            <team team-name="C Junioren" :players-array="{{$juniorC}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorD))
            <team team-name="D Junioren" :players-array="{{$juniorD}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorE))
            <team team-name="D Junioren" :players-array="{{$juniorE}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorF))
            <team team-name="F+G Junioren" :players-array="{{$juniorF}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($boardOfDirectors))
            <team :board-of-directors="true" team-name="Vorstand" :players-array="{{$boardOfDirectors}}">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @endif
    </section>
@endsection
