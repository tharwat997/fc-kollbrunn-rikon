@extends('admin.layouts.app')
@section('css')
{{--    <link href="{{asset('summernote/summernote-bs4.css')}}" rel="stylesheet">--}}
<link href="{{asset('summernote/summernote-bs4.css')}}" rel="stylesheet">
    <style type="text/css">
        .note-editor.note-frame{
            border:1px solid #e1e5eb;
            box-shadow: none;
            border-radius: 0.25rem;
        }
        .card-header.note-toolbar{
            border-radius: 0.25rem;
        }
        .ql-toolbar.ql-snow:first-child{
            display: none !important;
        }
        #eventManagementForm > div > div.col-lg-9.col-md-12 > div > div > div:nth-child(2) > div > div.note-toolbar.card-header > div.note-btn-group.btn-group.note-insert > button:nth-child(2),
        #eventManagementForm > div > div.col-lg-9.col-md-12 > div > div > div:nth-child(2) > div > div.note-toolbar.card-header > div.note-btn-group.btn-group.note-insert > button:nth-child(3){
            display: none;
        }
    </style>
@endsection
@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Create post</span>
            <h3 class="page-title">Create post</h3>
        </div>
    </div>
    <form id="eventManagementForm" action="{{route('post_store')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex">
            <div class="col-lg-9 col-md-12">

                <div class="card card-small mb-3">
                    <div class="card-body">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif

                            <div class="card-header">
                                <h6>Title</h6>
                                <input class="form-control"  required name="title" type="text" >
                            </div>
                            <div class="card-header">
                                <h6>Description</h6>
                                <textarea name="description" required id="summernote" >{{old('description')}}</textarea>
                            </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12">

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Upload image</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <input type="file" required class="form-control" name="image">
                        </div>
                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                            <span style="font-size: 9px; color:red; text-align: center;">Aspect ratio 4:3, Min width and height: 500</span>
                        </div>
                    </div>
                </div>

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Actions</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex px-3">
                                <button type="submit"  class="btn btn-block btn-primary">Post</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{asset('summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('summernote/summernote-de-DE.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 400,                 // set editor height
                maxHeight: 2000,             // set maximum height of editor
                focus: true,
                tabsize: 2,
                lang: 'de-DE'
            });
        });
    </script>
@endsection

