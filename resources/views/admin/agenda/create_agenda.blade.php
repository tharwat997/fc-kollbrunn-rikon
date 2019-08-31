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
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">On going events</span>
                            </div>
                           <div class="d-flex align-items-center">
                               <div class="mr-3">

                               </div>
                               <div class="checkbox">
                                   <label class="mb-0">
                                       <input type="hidden" checked name="recursiveOn" value="0">
                                       <input type="checkbox" id="recursiveOn" name="recursiveOn" value="1">On going
                                   </label>
                               </div>
                           </div>
                        </div>
                        <div class="input-group mb-3" style="display: none;">
                            <div class="input-group-append">
                                <span class="input-group-text">Recursive day</span>
                            </div>
                            <select name="dayOfWeek" id="dayOfWeek" class="form-control">
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="0">Sunday</option>
                            </select>
                        </div>
                        <div class="input-group mb-3" style="display: none">
                            <div class="input-group-append">
                                <span class="input-group-text">Duration of event</span>
                            </div>
                            <input type="number" class="form-control" id="durationOfEvent" placeholder="Duration in hours" name="durationOfEvent">
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
@section('js')
    <script type="text/javascript">
        $('#recursiveOn').change(function() {
            if($(this).is(":checked")) {
                $('#durationOfEvent').prop('required',true);
                $('#durationOfEvent').prop('required',true);
                $('#dayOfWeek').prop('required',true);
                $('#durationOfEvent').parent().toggle();
                $('#dayOfWeek').parent().toggle();
            }else{
                $('#durationOfEvent').parent().toggle();
                $('#durationOfEvent').prop('required',false);
                $('#dayOfWeek').prop('required',false);
                $('#dayOfWeek').parent().toggle();
            }
        });
    </script>
@endsection
