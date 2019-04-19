@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        /*#manageEventsTable img{*/
            /*height: 65px;*/
        /*}*/
    </style>
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Events</span>
            <h4 class="page-title">Manage events</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage events of event page</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="d-none">
                        @foreach($events as $event)
                            <form id="form-{{$event->id}}" action="{{route('events_update')}}" type="post" enctype="multipart/form-data">
                                {{csrf_token()}}
                            </form>
                        @endforeach
                    </div>
                    <div class="overflow-scroll">
                        <table id="manageEventsTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>Current Image</th>
                                <th>Image Upload</th>
                                <th>Created By</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    @foreach($event->image as $image)
                                        <tr>
                                            <td><input form="form-{{$event->id}}" required type="text" class="form-control" id="title{{$event->id}}" name="title" value="{{$event->title}}"></td>
                                            <td><textarea form="form-{{$event->id}}" required name="description" id="description{{$event->id}}" class="form-control">{{$event->description}}</textarea></td>
                                            <td><input form="form-{{$event->id}}" required type="text" id="location{{$event->id}}" class="form-control"  name="location" value="{{$event->location}}"></td>
                                            <td><input form="form-{{$event->id}}" required type="date" id="date{{$event->id}}" class="form-control"  name="start_date" value="{{$event->start_date}}"></td>
                                            <td><div class="d-flex align-items-center justify-content-center">
                                                    <img src="{{$image->getUrl('thumb')}}" class="img-fluid card-img">
                                                </div></td>
                                            <td><input form="form-{{$event->id}}" type="file" id="image{{$event->id}}"  class="form-control"  name="newImage"></td>
                                            <td><div class="d-flex">{{$event->creator_id}}</div></td>
                                            <td>
                                                <select form="form-{{$event->id}}" name="action" class="form-control" id="action{{$event->id}}">
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
            $('#manageEventsTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });

        } );

        @foreach($events as $event)
        $('#action{{$event->id}}').change(function () {
            if ($('#action{{$event->id}}').val() === 'delete'){
                $('#title{{$event->id}}').attr('required', false);
                $('#description{{$event->id}}').attr('required', false);
                $('#location{{$event->id}}').attr('required', false);
            } else {
                $('#title{{$event->id}}').attr('required', 'required');
                $('#description{{$event->id}}').attr('required', 'required');
                $('#location{{$event->id}}').attr('required', 'required');
            }
        });
        @endforeach
    </script>
@endsection
