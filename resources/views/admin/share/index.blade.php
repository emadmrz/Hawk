@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Shares
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Item</th>
                            <th>Visit</th>
                            <th>Social</th>
                            <th>Create. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shares as $key=>$share)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$share->shareable_type}}</td>
                                <td>{{$share->num_visit}}</td>
                                <td>{{$share->social}}</td>
                                <td>{{$share->shamsi_created_at}}</td>
                                <td>
                                    <a class="btn btn-info" href="#">Preview</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$shares->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
