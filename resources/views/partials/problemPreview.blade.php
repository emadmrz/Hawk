<div class="timeline-block">
    <div class="panel panel-default">
        <div class="panel-heading post-heading">

            <div class="media">
                <div class="media-right">
                    <a href="">
                        <img src="{{ asset('/img/persons/'.$problem->user->avatar) }}" title="{{ $problem->user->username }}" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('home.profile', $problem->user->id) }}">{{ $problem->user->username }}</a>
                    <span class="date" >شنبه 2 مهرماه 1395</span>
                </div>
            </div>

        </div>
        <div class="panel-body post-content">
            <div class="row">
                    <div class="col-sm-12 pull-right">
                        <p>{{ $problem->content }}</p>
                        @if(count($problem->files))
                            <div class="attachment" >
                                <div class="attachments-list">
                                    <ul>
                                        @foreach($problem->files as $attachment)
                                            <li><a target="_blank" href="{{ asset('img/files/'.$attachment->name) }}" >{{ $attachment->real_name }}</a><i class="fa fa-paperclip" ></i></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <div class="view-all-comments">
            <a href="#" class="pull-right">
                <i class="fa fa-comments-o"></i>
            </a>
            @if(count($problem->comments))
                <span>{{ $problem->num_comment }} دیدگاه</span>
            @else
                <span>اولین نفری باشد که دیدگاهتان را ثبت می کنید.</span>
            @endif
            <a class="report-content pull-left" href="{{route('profile.report.create',['type'=>'problem','id'=>$problem->id])}}">گزارش</a>
        </div>
        <ul class="comments" id="post_comments_list">
            <div class="list" data-nicescroll>
                @foreach($problem->comments->reverse() as $comment)
                    @include('partials.problemComment')
                @endforeach
            </div>
            <li class="comment-form">
                {!! Form::open(['route'=>['group.problem.comment.add', $problem->id], 'data-remote-multiple', 'id'=>'insert_post_comment_form']) !!}
                <div class="input-group ltr">
                    <input type="text" name="body" class="form-control rtl">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-grey"><i class="fa fa-paper-plane-o"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}
            </li>

        </ul>
    </div>
</div>