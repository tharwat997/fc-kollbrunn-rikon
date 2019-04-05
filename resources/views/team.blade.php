@extends('layouts.app')

@section('content')
    <section id="teamSection">
        <div class="container">
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
@endsection


