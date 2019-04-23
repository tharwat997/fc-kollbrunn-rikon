@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Board members</span>
            <h4 class="page-title">Add board members</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add members to board members</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('board_store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Member name</span>
                            </div>
                            <input type="text" name="name" class="form-control" required  aria-label="" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Member title</span>
                            </div>
                            <input type="text"  name="title" class="form-control" required  aria-label="" aria-describedby="basic-addon2" >
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Member email</span>
                            </div>
                            <input type="email"  name="email" class="form-control" required  aria-label="" aria-describedby="basic-addon2" >
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Member mobile number</span>
                            </div>
                            <input type="text"  name="mobile_number" class="form-control" required  aria-label="" aria-describedby="basic-addon2" >
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Member image</span>
                            </div>
                            <input type="file"  name="image" class="form-control" required  aria-label="" aria-describedby="basic-addon2" >
                        </div>

                        <div class="input-group d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
