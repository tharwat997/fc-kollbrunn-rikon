@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">User management</span>
            <h4 class="page-title">User management</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Manage user details</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="d-none">
                        @foreach($users as $user)
                            <form id="form-{{$user->id}}" action="{{route('user_update')}}" method="POST">
                                @csrf
                            </form>
                        @endforeach
                    </div>
                    <div class="overflow-scroll">
                        <table id="manageAgendaEventsTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                <th>Role</th>
                                @endif
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('reporter'))
                                    @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                        <tr>
                                            <td>
                                                <input form="form-{{$user->id}}" type="text" class="form-control" name="name" value="{{$user->name}}">
                                                <input type="hidden" form="form-{{$user->id}}" name="userId" value="{{$user->id}}">
                                            </td>
                                            <td><input form="form-{{$user->id}}" type="email"  class="form-control"  name="email" value="{{$user->email}}"></td>
                                            <td><input form="form-{{$user->id}}" type="password"  class="form-control"  name="password" value="{{$user->password}}"></td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                            <td>
                                                <select form="form-{{$user->id}}" name="role" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option {{$role->id  === $user->role_id ? 'selected' : ''}} value="{{$role->id}}">{{ $role->id == 1 ? 'Admin' : 'Reporter' }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endif
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <button form="form-{{$user->id}}" type="submit" name="btnUpdate" value="btnUpdate" class="btn btn-primary mb-2">Update</button>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                                        <button form="form-{{$user->id}}" type="submit" name="btnDelete" value="btnDelete" class="btn btn-danger">Delete</button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @else
                                    <tr>
                                        <td>
                                            <input form="form-{{$user->id}}" type="text" class="form-control" name="name" value="{{$user->name}}">
                                            <input type="hidden" form="form-{{$user->id}}" name="userId" value="{{$user->id}}">
                                        </td>
                                        <td><input form="form-{{$user->id}}" type="email"  class="form-control"  name="email" value="{{$user->email}}"></td>
                                        <td><input form="form-{{$user->id}}" type="password"  class="form-control"  name="password" value="{{$user->password}}"></td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                            <td>
                                                <select form="form-{{$user->id}}" name="role" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option {{$role->id  === $user->role_id ? 'selected' : ''}} value="{{$role->id}}">{{ $role->id == 1 ? 'Admin' : 'Reporter' }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex flex-column">
                                                <button form="form-{{$user->id}}" type="submit" name="btnUpdate" value="btnUpdate" class="btn btn-primary mb-2">Update</button>
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                                    <button form="form-{{$user->id}}" type="submit" name="btnDelete" value="btnDelete" class="btn btn-danger">Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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
