@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">
    <style type="text/css">
        .ql-toolbar.ql-snow:first-child{
            display: none !important;
        }
    </style>
@endsection
@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{$event->tite}} Management</span>
            <h3 class="page-title">Manage {{$event->title}} details</h3>
        </div>
    </div>
    <form id="eventManagementForm" action="{{route('events_update')}}" method="POST" enctype="multipart/form-data">
    <div class="row d-flex">
            @csrf
            <div class="col-lg-9 col-md-12" style="max-width: unset !important;">

                <div class="card card-small mb-3">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form class="add-new-post">
                            <div class="card-header">
                                <h6>Title</h6>
                                <input class="form-control"  required name="title" type="text" value="{{$event->title}}">
                            </div>
                            <div class="card-header">
                                <h6>Description</h6>
                                <textarea class="form-control"  name="description" required rows="20">{{$event->description}}</textarea>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12">

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Event Details</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-3 pb-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Location</span>
                                    </div>
                                    <input type="text"  class="form-control"  aria-label="location" name="location" aria-describedby="basic-addon1" required value="{{$event->location}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Start Date</span>
                                    </div>
                                    <input type="date"  class="form-control"  aria-label="Start Date" name="start_date" required value="{{$event->start_date}}" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Creator</span>
                                    </div>
                                    <input type="text"  disabled class="form-control" name="creator_id" placeholder="creator" aria-label="creator" aria-describedby="basic-addon1" value="{{$eventCreatorName}}">
                                </div>
                                <input type="hidden" name="eventId" value="{{$event->id}}">
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Current Image Preview</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-center mb-3 mt-2">
                            @foreach($event->image as $image)
                                <img src="{{$image->getUrl('card')}}" class="img-fluid w-50" alt="">
                            @endforeach
                        </div>
                        <div>
                            <input type="file" class="form-control" name="image">
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
                                <button type="submit"  value="delete" name="btnDelete" class="btn btn-sm btn-danger mr-auto">
                                    <i class="material-icons md-24">delete</i> Delete</button>
                                <button type="submit"  value="update" name="btnUpdate" class="btn btn-sm btn-primary">
                                    <i class="material-icons">update</i>Update</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </form>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>
    <script src="{{asset('admin_assets/scripts/app/app-blog-new-post.1.1.0.min.js')}}"></script>
@endsection

