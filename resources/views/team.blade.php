@extends('layouts.app')

@section('content')
    <section id="teamSection">
        @if(@isset($firstTeamUnformatted))
            <team team-name="Aktive" :players-array="{{$firstTeamUnformatted}}">
                @if(isset($image) && $image)
                    <img alt="team" class="w-100 img-fluid" src="{{$image}}"/>
                @endif
            </team>
        @elseif(@isset($juniorC))
            <team team-name="C Junioren" :players-array="{{$juniorC}}">
                @if(isset($image) && $image)
                    <img alt="team" class="w-100 img-fluid" src="{{$image}}"/>
                @endif
            </team>
        @elseif(@isset($juniorD))
            <team team-name="D Junioren" :players-array="{{$juniorD}}">
                @if(isset($image) && $image)
                    <img alt="team" class="w-100 img-fluid" src="{{$image}}"/>
                @endif
            </team>
        @elseif(@isset($juniorE))
            <team team-name="D Junioren" :players-array="{{$juniorE}}">
                @if(isset($image) && $image)
                    <img alt="team" class="w-100 img-fluid" src="{{$image}}"/>
                @endif
            </team>
        @elseif(@isset($juniorF))
            <team team-name="F+G Junioren" :players-array="{{$juniorF}}">
                @if(isset($image) && $image)
                    <img alt="team" class="w-100 img-fluid" src="{{$image}}"/>
                @endif
            </team>
        @elseif(@isset($boardOfDirectors))
            <team :board-of-directors="true" team-name="Vorstand" :players-array="{{$boardOfDirectors}}">
            </team>
        @endif
    </section>
@endsection
