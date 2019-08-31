@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Teams</span>
            <h4 class="page-title">Manage teams</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage teams</h6>
                </div>
                <div class="hidden">
                    @foreach($teams as $team)
                        <form action="{{route('teams_update')}}" method="post" id="form{{$team->id}}" enctype="multipart/form-data">
                            @csrf
                        </form>
                    @endforeach
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <table id="manageEventsTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Total Wins</th>
                            <th>Total Matches</th>
                            <th>Total Draws</th>
                            <th>Total Loses</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td>
                                    <input type="text" form="form{{$team->id}}" name="name" required
                                           class="form-control" value="{{$team->name}}">
                                    <input type="hidden" form="form{{$team->id}}" name="teamId" required
                                           class="form-control" value="{{$team->id}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$team->id}}" name="totalWins" required
                                           class="form-control" value="{{$team->totalWins}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$team->id}}" name="totalMatches" required
                                           class="form-control" value="{{$team->totalMatches}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$team->id}}" name="totalDraws" required
                                           class="form-control" value="{{$team->totalDraws}}">
                                </td>
                                <td>
                                    <input type="text" form="form{{$team->id}}" name="totalLoses" required
                                           class="form-control" value="{{$team->totalLoses}}">
                                </td>
                                <td>
                                    <input type="file" form="form{{$team->id}}" class="form-control" name="image">
                                </td>
                                <td>
                                    <div>{{$team->created_at}}</div>
                                </td>
                                <td>
                                    <div class="d-flex ">
                                        <div class="mr-1">
                                            <button type="submit" form="form{{$team->id}}" name="updateBtn"
                                                    value="updateBtn" class="btn btn-primary btn-block">Update
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" form="form{{$team->id}}" name="deleteBtn"
                                                    value="deleteBtn" class="btn btn-danger btn-block">Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#manageEventsTable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "scrollX": true
            });

        });
    </script>
@endsection
