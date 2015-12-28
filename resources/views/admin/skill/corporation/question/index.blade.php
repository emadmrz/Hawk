@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.skill.preview',[$user->id,$skill->id])}}" class="pull-right">{{$skill->title}}</a>
                Corporation Question Form
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Create. Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($answers as $key=>$answer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$skill->title}}</td>
                                <td>{{$answer->question->content}}</td>
                                <td>{{$answer->answer_name}}</td>
                                <td>{{$answer->shamsi_created_at}}</td>
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
