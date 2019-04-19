@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
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
                    <h6 class="m-0">Manage agenda events</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="d-none">
                        @foreach($agendaEvents as $event)
                        <form id="form-{{$event->id}}" action="{{route('agenda_events_update')}}" type="POST">
                        </form>
                        @endforeach
                    </div>
                        <div class="overflow-scroll">
                            <table id="manageAgendaEventsTable" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start Date Time</th>
                                    <th>End Date Time</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agendaEvents as $event)
                                    <tr>
                                        <td><input form="form-{{$event->id}}" type="text" class="form-control" name="title" value="{{$event->title}}"></td>
                                        <td><input form="form-{{$event->id}}" type="datetime-local"  class="form-control"  name="start_date" value="{{$event->start_date}}"></td>
                                        <td><input form="form-{{$event->id}}" type="datetime-local"  class="form-control"  name="end_date" value="{{$event->end_date}}"></td>
                                        <td>
                                            <select form="form-{{$event->id}}" name="action" class="form-control" id="action">
                                                <option value="update">update</option>
                                                <option value="delete">delete</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" form="form-{{$event->id}}" name="eventId" value="{{$event->id}}">
                                            <button form="form-{{$event->id}}" type="submit" class="btn btn-warning">Confirm</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#manageAgendaEventsTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                responsive: true
            });

        } );
    </script>
@endsection
