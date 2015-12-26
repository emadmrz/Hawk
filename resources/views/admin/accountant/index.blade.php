@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if($user!=null)
                    <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                @endif
                Payments
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>AU</th>
                            <th>Gate</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key=>$payment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$payment->user->username}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->description}}</td>
                                <td>{{$payment->au}}</td>
                                <td>{{$payment->gateway}}</td>
                                <td>{{$payment->shamsi_created_at}}</td>
                                <td>
                                    @if($payment->status==1)
                                        <button class="btn btn-success disabled">Paid</button>
                                    @elseif($payment->status==0)
                                        <button class="btn btn-warning disabled">UnPaid</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$payment->user->id])}}">Show Profile</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$payments->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
