@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if($user!=null)
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                @endif
                Groups
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Admin</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $key=>$group)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$group->name}}</td>
                                <td>{{$group->user->username}}</td>
                                <td>{{$group->shamsi_created_at}}</td>
                                <td>
                                    @if($group->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($group->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('group.index',[$group->id])}}">Preview</a>
                                    @if($group->active==1)
                                        <a href="{{route('admin.users.group.change',[$group->user->id,$group->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($group->active==0)
                                        <a href="{{route('admin.users.group.change',[$group->user->id,$group->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                    <a data-delete-confirm class="btn btn-danger" href="{{route('admin.users.group.delete',[$group->user->id,$group->id])}}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$groups->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
