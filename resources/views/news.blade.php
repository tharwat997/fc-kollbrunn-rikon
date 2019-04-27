@extends('layouts.app')
@section('content')
    <section id="newsPage">
        <div class="container">
            <b-card>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h2 class="mb-3">News</h2>
                        <h6>Something here about news</h6>
                    </div>
                </div>
                <div class="row">
                    @foreach($posts as $post)
                        @foreach($post->image as $image)
                        <div class="col-3 col-md-4 col-sm-6 col-xs-12 mb-4 eventCard">
                            <b-card  img-src="{{$image->getUrl('card')}}"  img-alt="Image" img-top>
                                <div class="eventCardTop d-flex justify-content-between">
                                    <div class="mb-2 eventName">{{$post->title}}</div>
                                    <div>{{$post->created_at}}</div>
                                </div>
                                <div class="eventCardBottom mt-4">
                                    <a href="{{route('news_show', ['id' => $post->id])}}" class="btn btn-primary btn-block">View</a>
                                </div>
                            </b-card>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </b-card>
        </div>
    </section>
@endsection