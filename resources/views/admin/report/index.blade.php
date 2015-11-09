@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Reports
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <a class="btn btn-details" href="{{route('admin.report.show',['cat'=>'all'])}}">All Reports</a>
                    <a class="btn btn-details" href="{{route('admin.report.show',['cat'=>'new'])}}">New Reports</a>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Link</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $key=>$report)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $report->user->username }}</td>
                                <td>{{$report->user->roles[0]->name}}</td>
                                <td>{{ $report->user->email }}</td>
                                <td><a href="{{$report->link}}">show</a></td>
                                <td>{{ $report->shamsi_created_at  }}</td>
                                @if($report->status==0)
                                    <td><a disabled class="btn btn-warning" href="#">new</a></td>
                                @elseif($report->status==1)
                                    <td><a disabled class="btn btn-success" href="#">checked</a></td>
                                @endif
                                @if($report->status==0)
                                    <td>
                                        {!! Form::open(['route'=>['admin.report.seen',$report->id]]) !!}
                                        <button class="btn btn-primary" type="submit">Seen</button>
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($report->status==1)
                                    <td>
                                        {!! Form::open(['route'=>['admin.report.unseen',$report->id]]) !!}
                                        <button class="btn btn-primary" type="submit">UnSeen</button>
                                        {!! Form::close() !!}
                                    </td>

                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $reports->render() !!}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
