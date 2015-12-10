@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Skills
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Create. Date</th>
                            <th>Owner</th>
                            <th>Rate</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $key=>$skill)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$skill->title}}</td>
                                <td>{{$skill->shamsi_created_at}}</td>
                                <td><a href="{{route('home.profile',[$skill->user->id])}}">{{$skill->user->username}}</a></td>
                                <td>{{$skill->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$skills->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
