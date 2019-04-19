@extends('layouts.app')

@section('content')
    <section id="teamSection">
        @if(@isset($firstTeam))
            <team team-name="First Team">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorC))
            <team team-name="Junior C">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorD))
            <team team-name="Junior D">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorE))
            <team team-name="Junior E">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($juniorF))
            <team team-name="Junior F">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @elseif(@isset($boardOfDirectors))
            <team :board-of-directors="true" team-name="Board of directors">
                <img alt="team" class="w-100 img-fluid" src="{{asset('images/teams/first_team/firstTeam1.jpg')}}" />
            </team>
        @endif
    </section>
@endsection
