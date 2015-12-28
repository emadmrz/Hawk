@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Buyers
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>username</th>
                            <th>Title</th>
                            <th>Real Amount</th>
                            <th>Pay Amount</th>
                            <th>Tracking Code</th>
                            <th>Legal Code</th>
                            <th>Status</th>
                            <th>Bought. Date</th>
                            <th>Expire. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buyers as $key=>$buyer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$buyer->user->username}}</td>
                                <td>{{$coupon->title}}</td>
                                <td>{{$coupon->real_amount}}</td>
                                <td>{{$coupon->pay_amount}}</td>
                                <td>{{$buyer->tracking_code}}</td>
                                <td>{{$buyer->legal_code}}</td>
                                <td>
                                    @if($buyer->status==0)
                                        <button class="btn btn-warning" disabled>UnPaid</button>
                                    @elseif($buyer->status==1)
                                        <button class="btn btn-primary" disabled>Paid</button>
                                    @elseif($buyer->status==2)
                                        <button class="btn btn-success" disabled>Used</button>
                                    @endif
                                </td>
                                <td>{{$buyer->shamsi_created_at}}</td>
                                <td>{{$service->shamsi_expired_at}}</td>
                                <td>
                                    <a href="{{route('home.profile',[$buyer->user->id])}}" class="btn btn-info">Show Profile</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$buyers->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
