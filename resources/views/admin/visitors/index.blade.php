@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <h5>View Method : </h5>
        <p>
            <a href="{{action('Admin\VisitorController@index',['Daily'])}}" class="btn btn-primary">Daily</a>
            <a href="{{action('Admin\VisitorController@index',['Weekly'])}}" class="btn btn-primary">Weekly</a>
            <a href="{{action('Admin\VisitorController@index',['Monthly'])}}" class="btn btn-primary">Monthly</a>
            <a href="{{action('Admin\VisitorController@index',['Yearly'])}}" class="btn btn-primary">Yearly</a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Visitors List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>Position</th>
                            <th>Browser</th>

                            <th>Date</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->ip }}</td>
                                <td>{{ $user->position }}</td>
                                <td>{{ $user->browser }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $users->render() !!}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->

        </div>
    </div>
@endsection