@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #manageEventsTable img{
            height: 65px;
            width: 65px;
        }
    </style>
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Board members</span>
            <h4 class="page-title">Manage board members</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage board members</h6>
                </div>
                <div class="hidden">
                    @foreach($members as $member)
                        <form action="{{route('board_update')}}" method="post" id="form{{$member->id}}" enctype="multipart/form-data">
                            @csrf
                        </form>
                    @endforeach
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="overflow-scroll">
                        <table id="manageEventsTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Member name</th>
                                <th>Member title</th>
                                <th>Member email</th>
                                <th>Member mobile number</th>
                                <th>Current Image</th>
                                <th>Member Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                @foreach($member->image as $image)
                                    <tr>
                                        <td style="width: 1%;">
                                            <input type="text" form="form{{$member->id}}" name="name" required class="form-control" value="{{$member->name}}">
                                            <input type="hidden" form="form{{$member->id}}" name="memberId" required class="form-control" value="{{$member->id}}">
                                            <div class="d-none">{{$member->name}}</div>
                                        </td>
                                        <td>
                                            <input type="text" form="form{{$member->id}}" name="title" required class="form-control" value="{{$member->title}}">
                                        </td>
                                        <td>
                                            <input type="email" form="form{{$member->id}}" name="email" required class="form-control" value="{{$member->email}}">
                                        </td>
                                        <td>
                                            <input type="text" form="form{{$member->id}}" name="mobile_number" required class="form-control" value="{{$member->mobile_number}}">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img src="{{$image->getUrl('thumb')}}" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="file" form="form{{$member->id}}" name="image"  class="form-control">
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <div class="mr-1">
                                                    <button type="submit" form="form{{$member->id}}" name="updateBtn" value="updateBtn" class="btn btn-primary btn-block">Update</button>
                                                </div>
                                                <div>
                                                    <button type="submit" form="form{{$member->id}}" name="deleteBtn" value="deleteBtn" class="btn btn-danger btn-block">Delete</button>
                                                </div>
                                            </div>
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
                    {
                        "className": "dt-center",

                    }
                ],
                "scrollX": true
            });

        } );
    </script>
@endsection
