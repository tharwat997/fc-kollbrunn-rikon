@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">User</span>
            <h4 class="page-title">Add user</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add user to system</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('user_store')}}" method="POST" id="createAgendaEventForm">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" required name="name" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="email" required name="email" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="password" required name="password" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Role</span>
                            </div>
                            <select name="role" required  class="form-control">
                                <option value="admin">Admin</option>
                                <option value="reporter">Reporter</option>
                            </select>
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

