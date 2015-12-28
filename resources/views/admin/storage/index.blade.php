@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Storage
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Volume</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($storages as $key=>$storage)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    {{$storage->capacity}} MB
                                </td>
                                <td>{{$storage->shamsi_created_at}}</td>
                                <td>
                                    @if($storage->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @elseif($storage->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @endif
                                    @if($storage->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($storage->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>
                                <td>
                                    @if($storage->active==1)
                                        <a href="{{route('admin.users.storage.change',[$user->id,$storage->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($storage->active==0)
                                        <a href="{{route('admin.users.storage.change',[$user->id,$storage->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$storages->render()}}</div>
                </div>
                <!-- /.table-responsive -->
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ($user->usage->usage)*100/($user->usage->capacity).'%'; ?>">
                    </div>
                </div>
                <div>
                    <span>{{$user->usage->usage}}MB /</span><span> {{$user->usage->capacity}}MB</span>
                </div>
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
