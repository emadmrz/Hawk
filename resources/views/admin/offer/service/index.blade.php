@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Services
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
                            <th>Create. Date</th>
                            <th>Expire. Date</th>
                            <th>Offer Expire. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $key=>$service)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$service->title}}</td>
                                <td>{{$service->description}}</td>
                                <td>{{$service->shamsi_created_at}}</td>
                                <td>{{$service->shamsi_expired_at}}</td>
                                <td>{{$offer->shamsi_expired_at}}</td>
                                <td>
                                    <a href="#" class="btn btn-info">Coupons</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$services->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
