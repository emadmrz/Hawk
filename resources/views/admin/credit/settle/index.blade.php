@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Settles
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $key=>$event)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $event->shamsi_from_time }}</td>
                                <td>{{ $event->shamsi_to_time }}</td>
                                <td>
                                    <a class="btn btn-danger" href="{{route('admin.settle.delete',$event->id)}}">del</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $events->render() !!}</div>
                </div>
                <!-- /.table-responsive -->
                <div class="col-sm-5">
                    <a class="btn btn-primary" href="{{route('admin.settle.create')}}">Set Settlement Period</a>
                </div>
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
