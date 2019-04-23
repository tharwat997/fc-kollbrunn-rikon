@extends('layouts.app')
@section('content')
    <section id="tickerSectionDetail">
        <div class="container p-0 border-0" style="border-radius: 4px;">
            <b-card>
                <div class="row mt-xl-3 d-flex align-items-center mb-4" id="tickerSectionDetailHeader">
                    <div class="col-sm-6">
                        <h3>{{$match->match_type}}</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h3 >{{$match->start_date_time}}</h3>
                    </div>
                </div>

                <div class="container p-0 mb-5">

                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchResultContainer">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                <div class="tickerMatchTeamAName">
                                    <h4>
                                        {{$match->teamA_name}}
                                    </h4>
                                </div>
                                <div class="tickerMatchTeamAScore">
                                    <h4>
                                        {{$match->teamA_score}}
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="tickerMatchTeamBName">
                                    <h4>
                                        {{$match->teamB_name}}
                                    </h4>
                                </div>
                                <div class="tickerMatchTeamBScore">
                                    <h4>
                                        {{$match->teamB_score}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchGoalsContainer">
                        <div class="col-sm-12 d-flex">
                            <div class="d-flex mr-auto flex-column align-items-center justify-content-center firstTeamMatchGoals">
                                <h1>{{substr($match->teamA_name, 0, 1)}}</h1>
                            </div>
                            <div class="d-flex flex-column combinedGoals">
                                <div class="leftGoal"><h4>Sam 90' <strong class="ml-3">2:1</strong></h4></div>
                                <div class="rightGoal"><h4><strong class="mr-3">2:1</strong> Sam 90'</h4></div>
                                <div class="leftGoal"><h4>Sam 90' <strong class="ml-3">2:1</strong></h4></div>
                            </div>
                            <div class="d-flex ml-auto flex-column align-items-center justify-content-center secondTeamMatchGoals">
                                <h1>{{substr($match->teamB_name, 0, 1)}}</h1>
                            </div>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4 class align-items-center" id="matchAllEvents">
                       <div class="col-sm-3 matchAllEventsMinute d-flex align-items-center justify-content-end">
                           <v-icon name="futbol" scale="3"></v-icon>
                           <h3 class="ml-3">90'</h3>
                       </div>
                       <div class="col-sm-9 matchAllEventsContent">
                           <div class="matchAllEventsContentTitle">
                               <h4>Goal! Werder Bremen Harnik Assist: Mohwald</h4>
                           </div>
                           <div class="matchAllEventsContentDescription">
                               <span>
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci debitis doloremque eaque eligendi, eos error eveniet inventore ipsa maiores nesciunt odio quia recusandae rerum veniam? Optio porro sapiente totam.
                               </span>
                           </div>
                       </div>
                    </div>
                    <div class="row pl-5 pr-5 pt-4 pb-4 class align-items-center" id="matchAllEvents">
                        <div class="col-sm-3 matchAllEventsMinute d-flex align-items-center justify-content-end">
                            <v-icon name="futbol" scale="3"></v-icon>
                            <h3 class="ml-3">90'</h3>
                        </div>
                        <div class="col-sm-9 matchAllEventsContent">
                            <div class="matchAllEventsContentTitle">
                                <h4>Goal! Werder Bremen Harnik Assist: Mohwald</h4>
                            </div>
                            <div class="matchAllEventsContentDescription">
                               <span>
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci debitis doloremque eaque eligendi, eos error eveniet inventore ipsa maiores nesciunt odio quia recusandae rerum veniam? Optio porro sapiente totam.
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-5 pr-5 pt-4 pb-4 class align-items-center" id="matchAllEvents">
                        <div class="col-sm-3 matchAllEventsMinute d-flex align-items-center justify-content-end">
                            <v-icon name="futbol" scale="3"></v-icon>
                            <h3 class="ml-3">90'</h3>
                        </div>
                        <div class="col-sm-9 matchAllEventsContent">
                            <div class="matchAllEventsContentTitle">
                                <h4>Goal! Werder Bremen Harnik Assist: Mohwald</h4>
                            </div>
                            <div class="matchAllEventsContentDescription">
                               <span>
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci debitis doloremque eaque eligendi, eos error eveniet inventore ipsa maiores nesciunt odio quia recusandae rerum veniam? Optio porro sapiente totam.
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-5 pr-5 pt-4 pb-4 class align-items-center" id="matchAllEvents">
                        <div class="col-sm-3 matchAllEventsMinute d-flex align-items-center justify-content-end">
                            <v-icon name="futbol" scale="3"></v-icon>
                            <h3 class="ml-3">90'</h3>
                        </div>
                        <div class="col-sm-9 matchAllEventsContent">
                            <div class="matchAllEventsContentTitle">
                                <h4>Goal! Werder Bremen Harnik Assist: Mohwald</h4>
                            </div>
                            <div class="matchAllEventsContentDescription">
                               <span>
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci debitis doloremque eaque eligendi, eos error eveniet inventore ipsa maiores nesciunt odio quia recusandae rerum veniam? Optio porro sapiente totam.
                               </span>
                            </div>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4 " id="matchComments">
                        <div class="col-sm-12">
                            <a href="" class="d-flex align-items-center justify-content-center">
                                <h4 class="numberOfComments">10</h4>
                                <h3>Comments</h3>
                            </a>
                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchInformation">
                        <div class="col-sm-12">
                           <div class="mb-4">
                               <h3>Information</h3>
                           </div>
                           <div>
                               <div class="mb-4"><h5>Starts: {{$match->start_date_time}}</h5></div>
                               <div class="mb-4"><h5>Match type: {{$match->match_type}}</h5></div>
                               <div class="mb-4"><h5>Last updated: {{$match->updated_at}}</h5></div>
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
                                <div class="mb-4"><h5>Name: Youssef</h5></div>
                                <div class="mb-4"><h5>Email: testing@gmail.com</h5></div>
                                <div class="mb-4"><h5>Mobile: 123456890</h5></div>
                            </div>

                        </div>
                    </div>

                </div>
            </b-card>
        </div>
    </section>
@endsection