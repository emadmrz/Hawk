@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Skills
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>rate</th>
                            <th>description</th>
                            <th>level</th>
                            <th>Create. Date</th>
                            <th>status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $key=>$skill)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$skill->title}}</td>
                                <td>{{$skill->rate}}</td>
                                <td>{{str_limit($skill->description,20)}}</td>
                                <td>
                                    @if($skill->my_rate==1)
                                        professional
                                    @elseif($skill->my_rate==2)
                                        intermediate
                                    @elseif($skill->my_rate==3)
                                        beginner
                                    @endif
                                </td>
                                <td>{{$skill->shamsi_created_at}}</td>
                                <td>
                                    @if($skill->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($skill->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.article.preview',[$skill->user->id,$skill->id])}}">Preview</a>
                                    @if($skill->active==1)
                                        <a href="{{route('admin.users.article.change',[$user->id,$skill->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($skill->active==0)
                                        <a href="{{route('admin.users.article.change',[$user->id,$skill->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                    <a class="btn btn-danger" data-delete-confirm href="{{route('admin.users.article.delete',[$skill->user->id,$skill->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$skills->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
