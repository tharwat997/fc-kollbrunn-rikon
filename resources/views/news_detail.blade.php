@extends('layouts.app')
@section('css')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        blockquote{
            line-height: normal;
        }
        p{
            font-size: 16px;
            line-height: normal;
        }
        #matchResultContainer h1{
            font-size: 2rem;
        }
    </style>
@endsection
@section('content')
    <section id="newsPostDetailSection">
        <div class="container p-0 border-0" style="border-radius: 4px;">
            <b-card>

                <div class="container p-0 mb-5 mt-4">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center align-items-center">
                                @foreach($post->image as $image)
                                    <img  class="img-fluid" src="{{$image->getUrl() }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchResultContainer">
                        <div class="col-sm-12 mb-4">
                            <h2>{{$post->title}}</h2>
                        </div>

                        <div class="col-sm-12">
                            {!! $post->body !!}
                        </div>
                    </div>

                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchInformation">
                        <div class="col-sm-12">
                            <div class="mb-4">
                                <h3>Information</h3>
                            </div>
                            <div>
                                <div class="mb-4"><h5>Created: {{$post->created_at}}</h5></div>
                                <div class="mb-4"><h5>Last updated: {{$post->updated_at}}</h5></div>
                            </div>

                        </div>
                    </div>
                    <hr class="border-bottomHr">
                    <div class="row pl-5 pr-5 pt-4 pb-4" id="matchReporterInformation">
                        <div class="col-sm-12">
                            <div class="mb-4">
                                <h3>Author</h3>
                            </div>
                            <div>
                                <div class="mb-4"><h5>Name: {{$post->author_id}}</h5></div>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-5 pr-5 pt-4" id="matchReporterInformation">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="mb-2">
                                    <h5>Share post</h5>
                                </div>
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_whatsapp"></a>
                            <a class="a2a_button_email"></a>
                            <a class="a2a_button_linkedin"></a>
                            <a class="a2a_button_telegram"></a>
                            <a class="a2a_button_tumblr"></a>
                            <a class="a2a_button_google_gmail"></a>
                            <a class="a2a_button_pinterest"></a>
                            <a class="a2a_button_skype"></a>
                            <a class="a2a_button_viber"></a>
                            <a class="a2a_button_copy_link"></a>
                            </div>

                            </div>
                        </div>
                    </div>

                </div>
            </b-card>
        </div>
    </section>
@endsection
