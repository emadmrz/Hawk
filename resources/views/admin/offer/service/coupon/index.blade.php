@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Coupons
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Real Amount</th>
                            <th>Pay Amount</th>
                            <th>Total Left</th>
                            <th>Create. Date</th>
                            <th>Expire. Date</th>
                            <th>Offer Expire. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $key=>$coupon)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$coupon->title}}</td>
                                <td>{{$coupon->description}}</td>
                                <td>{{$coupon->real_amount}}</td>
                                <td>{{$coupon->pay_amount}}</td>
                                <td>{{$coupon->num}}</td>
                                <td>{{$coupon->shamsi_created_at}}</td>
                                <td>{{$service->shamsi_expired_at}}</td>
                                <td>{{$offer->shamsi_expired_at}}</td>
                                <td>
                                    <a href="{{route('admin.users.offer.service.coupon.buyer.index',[$user->id,$offer->id,$service->id,$coupon->id])}}" class="btn btn-info">Buyers</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$coupons->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
