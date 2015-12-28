@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Files
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Size (MB)</th>
                            <th>Type</th>
                            <th>Create. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $key=>$file)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$file->real_name}}</td>
                                <td>{{$file->size}}</td>
                                <td>{{$file->extension}}</td>
                                <td>{{$file->shamsi_created_at}}</td>
                                <td>
                                    @if($file->imageable_type=='App\Product' || $file->imageable_type=='App\Shop')
                                        <a class="btn btn-info" href="{{asset('img/files/shop')}}/{{$file->name}}">Preview</a>
                                    @else
                                        <a class="btn btn-info" href="{{asset('img/files')}}/{{$file->name}}">Preview</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$files->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
