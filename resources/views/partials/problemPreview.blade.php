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

        </div>
        <ul class="comments" id="post_comments_list">
            <div class="list" data-nicescroll>
                @foreach($problem->comments->reverse() as $comment)
                    <li class="media">

                        <div class="pull-left">
                            @can('delete-problem-comment',[$problem,$comment])
                            {!! Form::open(['route'=>['group.problem.comment.delete', $problem->id, $comment->id], 'data-remote-multiple', 'id'=>'delete_post_comment_form']) !!}
                            <button class="glass-input" type="submit" ><i class="fa fa-trash-o"></i></button>
                            {!! Form::close() !!}
                            @endcan
                        </div>
                        <div class="pull-left">
                            @can('confirm-problem-answer',$problem)
                            {!! Form::open(['route'=>['group.problem.answer',$problem->id,$comment->id],'data-remote-multiple','id'=>'confirm_problem_answer_form']) !!}
                            <button class="btn btn-sm confirm-answer @if($problem->comment_id==$comment->id) btn-success @endif" type="submit"><i class="fa fa-check"></i></button>
                            {!! Form::close() !!}
                            @else
                                @if($problem->comment_id==$comment->id)
                                <span class="btn btn-success disabled">جواب صحیح</span>
                                @endif
                            @endcan
                        </div>
                        <div class="media-right">
                            <a href="">
                                <img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="" class="comment-author pull-right flip">{{ $comment->user->username }}</a>
                            <span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>
                            @can('update-problem-comment',[$comment])
                            <p><a data-post-inline-editable  id="body" data-type="textarea" data-rows="5" data-mode="inline" data-showbuttons="bottom" data-url="{{ route('group.problem.comment.update', [$problem->id, $comment->id]) }}" data-pk="{{ $comment->id }}">{{ $comment->body }}</a></p>
                            @else
                                <p>{{$comment->body}}</p>
                            @endcan


                        </div>
                    </li>
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