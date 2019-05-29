@extends('layouts.app')
@section('css')
    <style type="text/css">
        #events > div > div > div > div > div.row > div > div > img{
            width: unset !important;
        }
    </style>
@endsection
@section('content')
    <section id="events">
        <div class="container">
            <div class="row">
                <b-card>
                    <div class="card-title">
                        <h1>Veranstaltungen</h1>
                    </div>
                        <div class="row">
                            @foreach($events as $event)
                                @foreach($event->image as $image)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 eventCard">
                                    <b-card img-src="{{$image->getUrl('card')}}" img-alt="Image" img-top>
                                        <div class="eventCardTop">
                                            <div class="d-flex justify-content-between align-items-center eventDateLocationContainer">
                                                <div class="eventDate">{{$event->start_date}}</div>
                                                <div class="eventLocation d-flex align-items-center">
                                                    <v-icon name="map-marker-alt">
                                                    </v-icon>
                                                    <span class="ml-1">{{$event->location}}</span>
                                                </div>
                                            </div>
                                            <div class="mb-2 eventName">{{$event->title}}</div>
                                            <div class="eventDescription">
                                               {{$event->description}}
                                            </div>
                                        </div>
                                        <div class="eventCardBottom">
                                            <a href="{{route('contact_us')}}" class="btn btn-primary">Volunteer</a>
                                            <a href="{{route('contact_us')}}" class="btn btn-primary">Participate</a>
                                        </div>
                                    </b-card>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                </b-card>
            </div>
        </div>
    </section>
@endsection