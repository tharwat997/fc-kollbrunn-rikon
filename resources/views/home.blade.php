@extends('layouts.app')
@section('css')
    <style type="text/css">
        #newsSectionOne img{
            object-fit: cover;
            height: auto !important;
            vertical-align: top;
        }
        .VueCarousel-pagination{
            background: #000136;
        }
        .vuejs-countdown{
            text-align: center;
        }
        .vuejs-countdown .text{
            font-size: 2em !important;
        }
        .vuejs-countdown .digit{
            font-size: 5em !important;
        }
        .vuejs-countdown li:after{
            font-size: 4em !important;
        }
        #newsTickerContainer > div{
            height: 100%;
        }
        #newsTickerContainer > div > div.VueCarousel-wrapper > div{
            height: 100% !important;
        }
        #newsTickerContainer > div > div.VueCarousel-wrapper{
            height: 100% !important;
        }
        #newsTickerContainer .VueCarousel-slide{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        #newsSectionOne > div > div.VueCarousel-wrapper > div > div.VueCarousel-slide > div > a{
            width: 100%;
            position: absolute;
            font-size: 3em;
            bottom: 20%;
            text-align: center;
            height: unset;
            color:white;
            text-decoration: none;
            z-index: 999999;
        }
        #newsSectionOne > div > div.VueCarousel-wrapper > div > div.VueCarousel-slide > div > a:hover{
            color:lightgray;
        }
    </style>
@endsection
@section('content')
    <section id="newsTickerSection">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6" id="newsSectionOne">
                    <carousel :autoplay="true" pagination-active-color="#FFD950" :per-page="1">
                        @foreach($posts4 as $post)
                            @foreach($post->getMedia('postsImages') as $image)
                                <slide>
                                    <div class="d-flex newsImageContainer">
                                        <img alt="ca" class="img-fluid" srcset="{{$image->getUrl('newsHome')}}" />
                                        <a href="{{route('news_show', ['id' => $post->id])}}">{{$post->title}}</a>
                                    </div>

                                </slide>
                            @endforeach
                        @endforeach
                    </carousel>
                </div>
                <div class="col-sm-6" id="newsTickerContainer">
                    <carousel :autoplay="true" pagination-active-color="#FFD950" :per-page="1">
                        @foreach($matches as $match)
                        <slide>
                            <div class="tickerMatch d-flex p-4 flex-column">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div>{{$match['match_type']}}</div>
                                    <div>{{$match['start_date_time']}}</div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3>{{$match['teamA_name']}}</h3>
                                        </div>
                                        <div>
                                            <h3>{{$match['teamA_score']}}</h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3>{{$match['teamB_name']}}</h3>
                                        </div>
                                        <div>
                                            <h3>{{$match['teamB_score']}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-100 d-flex align-items-center justify-content-center">

                                @if($match['start_date_time2'] <= \Illuminate\Support\Carbon::now()->setTimezone('Europe/Zurich')
                                && $match['start_date_time3'] <= 150)
                                    <count :matches="{{json_encode($matches2)}}" :match="{{json_encode($match['id'])}}"></count>
                                @elseif (\Illuminate\Support\Carbon::parse($match['start_date_time']) > \Carbon\Carbon::today())
                                    <Countdown end="{{$match['start_date_time']}}"></Countdown>
                                @else
                                    <h2>Match has ended</h2>
                                @endif
                            </div>
                        </slide>
                        @endforeach
                    </carousel>
                </div>
            </div>
        </div>
    </section>

    <section class="cd-horizontal-timeline" id="timelineSection">
        <div class="container-fluid">
            <div class="container">
                <div id="timeline-section-header-container">
                    <h1 class="timeline-section-header">Veranstaltungen</h1>
                </div>
                <div id="timeline">
                    <home-timeline></home-timeline>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
