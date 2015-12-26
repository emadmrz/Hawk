@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Questionnaires
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
                            <th>Num</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questionnaires as $key=>$questionnaire)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$questionnaire->title}}</td>
                                <td>{{$questionnaire->description}}</td>
                                <td>{{$questionnaire->count}}</td>
                                <td>{{$questionnaire->shamsi_created_at}}</td>
                                <td>
                                    @if($questionnaire->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @elseif($questionnaire->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @elseif($questionnaire->status==2)
                                        <button class="btn btn-success disabled">Published</button>
                                    @endif
                                    @if($questionnaire->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($questionnaire->active==0)
                                            <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.questionnaire.preview',[$user->id,$questionnaire->id])}}">Preview</a>
                                    @if($questionnaire->active==1)
                                        <a href="{{route('admin.users.questionnaire.change',[$user->id,$questionnaire->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($questionnaire->active==0)
                                        <a href="{{route('admin.users.questionnaire.change',[$user->id,$questionnaire->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$questionnaires->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
