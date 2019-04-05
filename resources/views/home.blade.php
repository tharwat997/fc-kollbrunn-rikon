@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/timeline-componenet/reset.css')}}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{asset('css/timeline-componenet/style.css')}}"> <!-- Resource style -->
    <script src="{{asset('js/timeline-component/modernizr.js')}}"></script> <!-- Modernizr -->
@endsection

@section('content')
    <div class="row" id="newsTickerSection">
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
    <section class="cd-horizontal-timeline container" id="timelineSection">
        <h1 class="timeline-section-header">Upcoming Events</h1>
    <div class="timeline">
        <div class="events-wrapper">
            <div class="events">
                <ol>
                    <li><a href="#0" data-date="16/01/2019" class="selected">16 Jan</a></li>
                    <li><a href="#0" data-date="28/02/2019">28 Feb</a></li>
                    <li><a href="#0" data-date="20/04/2019">20 Mar</a></li>
                    <li><a href="#0" data-date="20/05/2019">20 May</a></li>
                    <li><a href="#0" data-date="09/07/2019">09 Jul</a></li>
                    <li><a href="#0" data-date="30/08/2019">30 Aug</a></li>
                    <li><a href="#0" data-date="15/09/2019">15 Sep</a></li>
                </ol>

                <span class="filling-line" aria-hidden="true"></span>
            </div> <!-- .events -->
        </div> <!-- .events-wrapper -->

        <ul class="cd-timeline-navigation">
            <li>
                <a href="#0" class="prev inactive d-flex align-items-center justify-content-center">
                    <img  src="{{asset('images/icons/baseline-chevron_right-24px.svg')}}" />
                </a>
            </li>
            <li>
                <a href="#0" class="next d-flex align-items-center justify-content-center">
                    <img  src="{{asset('images/icons/baseline-chevron_right-24px.svg')}}" />
                </a>
            </li>
        </ul> <!-- .cd-timeline-navigation -->

    </div> <!-- .timeline -->

    <div class="events-content">
        <ol>
            <li class="selected" data-date="16/01/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="28/02/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="20/04/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="20/05/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="09/07/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="30/08/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>

            <li data-date="15/09/2019">
                <h2 class="event-title">Horizontal Timeline</h2>
                <em class="event-date">January 16th, 2019</em>
                <p class="event-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                </p>
            </li>
        </ol>
    </div> <!-- .events-content -->
    </section>
@endsection

@section('js')
    <script src="{{asset('js/timeline-component/jquery-2.1.4.js')}}"></script>
    <script src="{{asset('js/timeline-component/jquery.mobile.custom.min.js')}}"></script>
    <script src="{{asset('js/timeline-component/main.js')}}"></script>

@endsection
