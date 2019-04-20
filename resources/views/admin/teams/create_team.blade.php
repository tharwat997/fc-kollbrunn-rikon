@extends('admin.layouts.app')
@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Teams</span>
            <h4 class="page-title">Add team</h4>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add team to teams</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form  action="{{route('teams_store')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Team name</span>
                            </div>
                            <input type="text" name="teamName" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Total wins</span>
                            </div>
                            <input type="number"  name="totalWins" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Total matches</span>
                            </div>
                            <input type="number"  name="totalMatches" class="form-control" required placeholder="" aria-label="" aria-describedby="basic-addon2" value="0">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Total loses</span>
                            </div>
                            <input type="number" name="totalLosses" class="form-control" required aria-label="" aria-describedby="basic-addon2" value="0">
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
