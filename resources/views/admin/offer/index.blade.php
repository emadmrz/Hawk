@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Offers
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Pay Status</th>
                            <th>Status</th>
                            <th>Create. Date</th>
                            <th>Expire. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $key=>$offer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    @if($offer->status==1)
                                        <button class="btn btn-success disabled">Bought</button>
                                    @elseif($offer->status==0)
                                        <button class="btn btn-warning">Buy Problem</button>
                                    @endif
                                    @if($offer->paid==1)
                                            <button class="btn btn-success" disabled>Paid</button>
                                        @elseif($offer->paid==0)
                                        <button class="btn btn-warning" disabled>Not Settled</button>
                                    @endif
                                </td>
                                <td>
                                    @if($offer->active==1)
                                        <button class="btn btn-success" disabled>Active</button>
                                    @elseif($offer->active==0)
                                        <button class="btn btn-danger" disabled>banned</button>
                                    @endif
                                </td>
                                <td>{{$offer->shamsi_created_at}}</td>
                                <td>{{$offer->shamsi_expired_at}}</td>
                                <td>
                                    @if($offer->active==1)
                                        <a data-post-ban class="btn btn-warning" href="{{route('admin.users.offer.change',[$user->id,$offer->id])}}">ban</a>
                                    @elseif($offer->active==0)
                                        <a data-post-active class="btn btn-primary" href="{{route('admin.users.offer.change',[$user->id,$offer->id])}}">Active</a>
                                    @endif
                                    <a class="btn btn-info" href="{{route('admin.users.offer.service.index',[$user->id,$offer->id])}}">Services</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$offers->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
