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
        .dropdown-menu{
            max-height: 200px;
            overflow: scroll;
        }
        #eventManagementForm > div > div.col-lg-9.col-md-12 > div > div > div:nth-child(2) > div{
            z-index: 9999;
        }
    </style>
@endsection
@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{$post->tite}} Management</span>
            <h3 class="page-title">Manage {{$post->title}} details</h3>
        </div>
    </div>
    <form id="eventManagementForm" action="{{route('post_update')}}" method="POST" enctype="multipart/form-data">
    <div class="row d-flex">
            @csrf
            <div class="col-lg-9 col-md-12" >

                <div class="card card-small mb-3">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form class="add-new-post">
                            <div class="card-header">
                                <h6>Title</h6>
                                <input class="form-control"  required name="title" type="text" value="{{$post->title}}">
                            </div>
                            <div class="card-header">
                                <h6>Description</h6>
                                <textarea name="description" class="summernote" required id="summernote"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12">

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <div class="card card-small mb-3">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Post Details</h6>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-3 pb-2">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Author</span>
                                        </div>
                                        <select name="author" required class="form-control">
                                            @foreach($authors as $author)
                                                <option {{ $author->id === $post->author_id ? 'selected' : '' }} value="{{$author->id}}">{{$author->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="postId" value="{{$post->id}}">
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Current Image Preview</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-center mb-3 mt-2">
                            @foreach($post->getMedia('postsImages') as $image)
                                <img src="{{$image->getUrl('card')}}" class="img-fluid w-50" alt="">
                            @endforeach
                        </div>
                        <div>
                            <input type="file" class="form-control" name="image">
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
                        <div class="d-flex flex-column p-2">
                            <button type="submit"  value="update" name="btnUpdate" class="btn btn-block btn-primary">
                                <i class="material-icons">update</i>Update</button>
                            <button type="submit"  value="delete" name="btnDelete" class="btn btn-block btn-danger mb-2">
                                <i class="material-icons md-24">delete</i> Delete</button>
                        </div>
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

            $('.summernote').summernote('code', {!! json_encode($post->body) !!});
        });

    </script>
@endsection

