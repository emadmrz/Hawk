@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Shops
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Visit</th>
                            <th>Buy</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shops as $shop)
                            <tr>

                                <td>{{$shop->title}}</td>
                                <td>{{$shop->num_visit}}</td>
                                <td>{{$shop->num_buy}}</td>
                                <td>{{$shop->shamsi_created_at}}</td>
                                <td>
                                    @if($shop->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @elseif($shop->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @endif
                                    @if($shop->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($shop->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.shop.index',[$shop->id])}}">Preview</a>
                                    <a class="btn btn-info" href="{{route('admin.users.shop.product.index',[$user->id,$shop->id])}}">Products</a>
                                    @if($shop->active==1)
                                        <a href="{{route('admin.users.shop.change',[$user->id,$shop->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($shop->active==0)
                                        <a href="{{route('admin.users.shop.change',[$user->id,$shop->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$shops->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
