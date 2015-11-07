@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Settle Requests
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>Amount</th>
                            <th>Create Date</th>
                            <th>Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $key=>$request)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $request->user->username }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{$request->shamsi_created_at}}</td>
                                <td>
                                    @if($request->status==0)
                                        <a class="btn btn-primary" href="{{route('admin.settle.edit',$request->id)}}">Pay / Deny</a>
                                    @elseif($request->status==1)
                                        <a disabled class="btn btn-success" href="#">Paid</a>
                                    @elseif($request->status==2)
                                        <a disabled class="btn btn-danger" href="#">Denied</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $requests->render() !!}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
