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
                    <div class="">
                        <table id="manageEventsTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($posts))
                                @foreach($posts as $post)
                                    @foreach($post->getMedia('postsImages') as $image)
                                        <tr>
                                            <td><div>{{$post->title}}</div></td>
                                            <td><div>{{$post->author_id}}</div></td>
                                            <td><div class="d-flex align-items-center justify-content-center">
                                                    <img src="{{$image->getUrl('thumb')}}" class="img-fluid card-img">
                                                </div>
                                            </td>
                                            <td><div>{{$post->created_at}}</div></td>
                                            <td><div>{{$post->updated_at}}</div></td>
                                            <td>
                                                <div class="mb-2"><a class="btn btn-primary btn-block" href="{{route('posts_manage_show', ['id' => $post->id])}}">Edit</a></div>
                                                <div>
                                                    <form action="{{route('post_update')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="postId" value="{{$post->id}}">
                                                        <button class="btn btn-danger btn-block" name="btnDelete" value="btnDelete" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
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
    </script>
@endsection
