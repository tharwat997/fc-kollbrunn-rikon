@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Agenda</span>
            <h4 class="page-title">Add event</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add event to agenda</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('agenda_events_store')}}" method="POST" id="createAgendaEventForm">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Event title</span>
                            </div>
                            <input type="text" required name="event-title" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Start date and time</span>
                            </div>
                            <input type="datetime-local" required name="startDateTime" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">End date and time</span>
                            </div>
                            <input type="datetime-local" required name="endDateTime" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
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
