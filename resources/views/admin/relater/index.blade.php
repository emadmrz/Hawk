@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Relaters
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Type</th>
                            <th>Expire. Date</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($relaters as $key=>$relater)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    @if($relater->type==1)
                                        <button class="btn btn-info disabled">Golden</button>
                                    @elseif($relater->type==2)
                                        <button class="btn btn-info disabled">Silver</button>
                                    @elseif($relater->type==3)
                                        <button class="btn btn-info disabled">Bronze</button>
                                    @endif
                                </td>
                                <td>{{$relater->shamsi_expired_at}}</td>
                                <td>{{$relater->shamsi_created_at}}</td>
                                <td>
                                    @if($relater->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @elseif($relater->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @endif
                                    @if($relater->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($relater->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>
                                <td>
                                    @if($relater->active==1)
                                        <a href="{{route('admin.users.relater.change',[$user->id,$relater->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($relater->active==0)
                                        <a href="{{route('admin.users.relater.change',[$user->id,$relater->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$relaters->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
