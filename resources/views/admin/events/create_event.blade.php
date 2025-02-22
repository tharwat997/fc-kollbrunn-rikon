@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Events</span>
            <h4 class="page-title">Add event</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add event to events page</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('events_store')}}" method="POST" id="createEventForm" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Event title</span>
                            </div>
                            <input type="text" name="eventTitle" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2" value="{{ old('eventTitle') }}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Event description</span>
                            </div>
                            <textarea rows="5" name="eventDescription" required class="form-control">{{ old('eventDescription') }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Start date</span>
                            </div>
                            <input type="date"  name="startDate" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2" value="{{old('startDate') }}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Event Location</span>
                            </div>
                            <input type="text" name="eventLocation" class="form-control" required placeholder="Zurich, Switzerland" aria-label="" aria-describedby="basic-addon2" value="{{old('eventLocation') }}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Event Image</span>
                            </div>
                            <input required type="file" name="eventImage" class="form-control"  aria-label="" aria-describedby="basic-addon2">
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
