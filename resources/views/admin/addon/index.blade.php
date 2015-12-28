@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Addons
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key=>$payment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <?php
                                        $addonArray=explode('\\',$payment->itemable_type);
                                        echo $addonArray[1];
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('store.'.lcfirst($addonArray[1]))}}">Preview</a>
                                    <a class="btn btn-info" href="{{route('admin.users.'.lcfirst($addonArray[1]).'.index',[$user->id])}}">Select</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
