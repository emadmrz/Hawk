@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Latest Posts
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestPosts as $key=>$post)
                            <tr>
                                <td>{{$post->user->username}}</td>
                                <td>{{str_limit($post->content,20)}}</td>
                                <td>
                                    @if($post->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($post->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.post.preview',[$post->user->id,$post->id])}}">Preview</a>
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
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Latest Articles
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestArticles as $key=>$article)
                            <tr>
                                <td>{{$article->user->username}}</td>
                                <td>{{$article->title}}</td>
                                <td>
                                    @if($article->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($article->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.article.preview',[$article->user->id,$article->id])}}">Preview</a>
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
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Latest Problems
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestProblems as $key=>$problem)
                            <tr>
                                <td>{{$problem->user->username}}</td>
                                <td>{{str_limit($problem->content,10)}}</td>
                                <td>
                                    @if($problem->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($problem->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('group.problemPreview',[$problem->parentable->id,$problem->id])}}">Preview</a>
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
    <div class="col-lg-12">
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Latest Groups
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Admin</th>
                            <th>name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestGroups as $key=>$group)
                            <tr>
                                <td>{{$group->user->username}}</td>
                                <td>{{$group->name}}</td>
                                <td>
                                    @if($group->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($group->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('group.index',[$group->id])}}">Preview</a>
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
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Latest Users
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestUsers as $key=>$user)
                            <tr>
                                <td>{{$user->username}}</td>
                                <td>{{$user->roles[0]->name}}</td>
                                <td>
                                    @if($user->status==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($user->status==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$user->id])}}">Preview</a>
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
        <div style="padding-left: 0; padding-right: 0;" class="col-md-4 panel panel-default">
            <div class="panel-heading">
                Most Popular Users
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ratedUsers as $key=>$user)
                            <tr>
                                <td>{{$user->username}}</td>
                                <td>{{$user->rate}}</td>
                                <td>
                                    @if($user->status==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($user->status==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$user->id])}}">Preview</a>
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
    <div class="col-lg-12">

        <div id="myfirstchart" style="height: 250px;"></div>

    </div>
@endsection
@section('script')
    {{--Create By Dara on 13/9/2015
    handling the morris diagram--}}
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($chartDatas as $data)
                    {day: '{{$data['date']}}', value: '{{$data['count']}}' },
                @endforeach



        ],
            // The name of the data record attribute that contains x-values.
            xkey: 'day',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value'],
            xLabels:"day"
        });
    </script>


@endsection
