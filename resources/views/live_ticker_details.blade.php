@extends('layouts.app')
@section('content')
    <section id="tickerSectionDetail">
        <div class="container p-0 border-0" style="border-radius: 4px;">
            <b-card>
                <div class="row mt-xl-3 d-flex align-items-center mb-4" id="tickerSectionDetailHeader">
                    <div class="col-sm-6">
                        <h3>{{$match['match_type']}}</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h3 >{{$match['start_date_time']}}</h3>
                    </div>
                </div>

                <div class="container p-0 mb-5">
                    <div class="row mt-4">
                        <div class="col-sm-12">
                             <div class="d-flex justify-content-center align-items-center">
                                @if($match['start_date_time'] <= \Illuminate\Support\Carbon::now()->setTimezone('Europe/Zurich')
                                && $match['start_date_time2'] <= 150)
                                <counti :match="{{json_encode($match)}}"></counti>
                                @elseif($match['start_date_time'] > \Illuminate\Support\Carbon::now()->setTimezone('Europe/Zurich'))
                                    <h2>Match has not yet started</h2>
                                @else
                                    <h2>Match has ended</h2>
                                @endif
                             </div>
                        </div>
                    </div>
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchResultContainer">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                <div class="tickerMatchTeamAName">
                                    <h4>
                                        {{$match['teamA_name']}}
                                    </h4>
                                </div>
                                <div class="tickerMatchTeamAScore">
                                    <h4>
                                        {{$match['teamA_score']}}
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="tickerMatchTeamBName">
                                    <h4>
                                        {{$match['teamB_name']}}
                                    </h4>
                                </div>
                                <div class="tickerMatchTeamBScore">
                                    <h4>
                                        {{$match['teamB_score']}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchGoalsContainer">
                        <div class="col-sm-12 d-flex">
                            <div class="d-flex mr-auto flex-column align-items-center justify-content-center firstTeamMatchGoals">
                                <h1>{{substr($match['teamA_name'], 0, 1)}}</h1>
                            </div>
                            <div class="d-flex combinedGoals justify-content-center">
                                <div class="leftSectionGoals d-flex flex-column align-items-center">

                                    @foreach($events as $event)
                                        @if($event->player_idHome != null && $event->goal != null)
                                            <div class="leftGoal"><h4>{{ $event->player_idHome}} {{$event->minute_of_event}}'</h4></div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="rightSectionGoals d-flex flex-column align-items-center">
                                    @foreach($events as $event)
                                        @if($event->playerNameAway != null && $event->goal != null)
                                            <div class="rightGoal"><h4>{{ $event->playerNameAway}} {{$event->minute_of_event}}'</h4></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex ml-auto flex-column align-items-center justify-content-center secondTeamMatchGoals">
                                <h1>{{substr($match['teamB_name'], 0, 1)}}</h1>
                            </div>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    @foreach($events as $event)
                        <div class="row pl-5 pr-5 pt-4 pb-4 class align-items-center" id="matchAllEvents">
                            <div class="col-sm-3 matchAllEventsMinute d-flex align-items-center justify-content-end">
                                @if( $event->yellow_card === 1)
                                    <img src="{{asset('images/icons/ticker_icons/yellow-card.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @elseif($event->red_card === 1)
                                    <img src="{{asset('images/icons/ticker_icons/red-card.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @elseif($event->injury === 1)
                                    <img src="{{asset('images/icons/ticker_icons/first-aid-kit.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @elseif($event->assist === 1)
                                    <img src="{{asset('images/icons/ticker_icons/football-boots.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @elseif($event->goal === 1 )
                                    <img src="{{asset('images/icons/ticker_icons/football.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @elseif($event->substitute)
                                    <img src="{{asset('images/icons/ticker_icons/football-shirt.svg')}}" style="width: 35%;" class="img-fluid" alt="event icon">
                                @endif
                                <h3 class="ml-3">{{$event->minute_of_event}}'</h3>
                            </div>
                            <div class="col-sm-9 matchAllEventsContent">
                                <div class="matchAllEventsContentTitle">
                                    <h4>{{$event->title}}</h4>
                                </div>
                                <div class="matchAllEventsContentDescription">
                               <span>
                                   {{$event->description}}
                               </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4 " id="matchComments">
                        <div class="col-sm-12">
                            <a href="#" onclick="event.preventDefault()" v-b-toggle.accordion-1 class="d-flex align-items-center justify-content-center">
                                <h4 class="numberOfComments">{{count($comments)}}</h4>
                                <h3>Kommentare</h3>
                            </a>
                        </div>
                        <div class="col-sm-12">
                            <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div id="commentSectionForm">
                                       <div>
                                           <h4 class="mb-3">Kommentiere hier</h4>
                                       </div>
                                        <div>
                                            <form action="{{route('comments_store')}}" method="post">
                                                @csrf
                                                @honeypot
                                                <div>
                                                    <div class="mb-1">
                                                        <input type="text" autocomplete="off" required name="commentName" class="form-control" placeholder="Name">
                                                        <input type="hidden"  name="matchId" value="{{$match['id']}}">
                                                    </div>

                                                    <b-form-textarea
                                                            id="textarea-no-resize"
                                                            placeholder="Kommentiere hier"
                                                            rows="3"
                                                            no-resize
                                                            class="status-box"
                                                            name="commentBody"
                                                            :required="true"
                                                    ></b-form-textarea>
                                                </div>
                                                <div class="button-group d-flex justify-content-end align-items-center mt-3">
                                                    <button type="submit" class="btn btn-primary">Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr class="border-bottomHr">
                                    <div id="commentSectionComments" class="d-flex flex-wrap">
                                        @foreach($comments as $comment)
                                            <b-card class="mb-3 w-100">
                                                <div>
                                                    <div class="mb-3">
                                                        <div><h6><strong>{{$comment->name}}</strong></h6></div>
                                                        <div><span>{{$comment->created_at}}</span></div>
                                                    </div>
                                                    <div>
                                                        <p class="m-0">{{$comment->comment}}</p>
                                                    </div>
                                                </div>
                                            </b-card>
                                        @endforeach
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchInformation">
                        <div class="col-sm-12">
                           <div class="mb-4">
                               <h3>Information</h3>
                           </div>
                           <div>
                               <div class="mb-4"><h5>Start: {{$match['start_date_time']}}</h5></div>
                               <div class="mb-4"><h5>Typ: {{$match['match_type']}}</h5></div>
                               <div class="mb-4"><h5>Letzte Aktuallisierung: {{$match['updated_at']}}</h5></div>
                           </div>

                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchReporterInformation">
                        <div class="col-sm-12">
                            <div class="mb-4">
                                <h3>Reporter</h3>
                            </div>
                            <div>
                                <div class="mb-4"><h5>Name: {{$reporterName}}</h5></div>
                                <div class="mb-4"><h5>Email: {{$reporterEmail}}</h5></div>
                            </div>

                        </div>
                    </div>

                </div>
            </b-card>
        </div>
    </section>
@endsection
