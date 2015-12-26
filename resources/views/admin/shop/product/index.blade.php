@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Products
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Visit</th>
                            <th>Buy</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->num_visit}}</td>
                                <td>{{$product->num_buy}}</td>
                                <td>{{$product->shamsi_created_at}}</td>
                                <td>
                                    @if($product->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($product->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.shop.product',[$shop->id,$product->id])}}">Preview</a>
                                    @if($shop->active==1)
                                        <a href="{{route('admin.users.shop.product.change',[$user->id,$shop->id,$product->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($shop->active==0)
                                        <a href="{{route('admin.users.shop.product.change',[$user->id,$shop->id,$product->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$products->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
