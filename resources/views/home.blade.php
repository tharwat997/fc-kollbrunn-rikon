@extends('layouts.app')
@section('content')
    <section id="newsTickerSection">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6" id="newsSectionOne">
                    <carousel :autoplay="true" pagination-active-color="#FFD950" :per-page="1">
                        <slide>
                            <a href="#"> </a>
                            <img alt="ca" class="img-fluid" src="https://placeimg.com/640/480/any" />
                        </slide>
                        <slide>
                            <a href=""></a>
                            <img alt="ca" class="img-fluid" src="https://placeimg.com/640/480/any" />
                        </slide>
                    </carousel>
                </div>
                <div class="col-sm-6" id="newsTickerContainer">
                    <div class="d-flex flex-column align-items-center">
                        <div id="tickerSection">
                            <a href=""><img alt="ca" class="img-fluid" src="https://placeimg.com/640/240/any" /></a>
                        </div>
                        <div id="newsSectionTwo" class="d-flex justify-content-center align-items-center">
                            <div>
                                <a href=""><img alt="ca" class="img-fluid" src="https://placeimg.com/640/480/any" /></a>
                            </div>
                            <div>
                                <a href=""><img alt="ca" class="img-fluid" src="https://placeimg.com/640/480/any" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cd-horizontal-timeline" id="timelineSection">
        <div class="container-fluid">
            <div class="container">
                <div id="timeline-section-header-container">
                    <h1 class="timeline-section-header">Upcoming Events</h1>
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
{{--@section('js')--}}
    {{--<script>--}}
        {{--import HomeTimeline from "../js/components/home-timeline";--}}
        {{--export default {--}}
            {{--components: {HomeTimeline}--}}
        {{--}--}}
    {{--</script>--}}
{{--@endsection--}}