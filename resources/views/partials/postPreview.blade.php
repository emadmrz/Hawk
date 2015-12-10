<div class="timeline-block">
    <div class="panel panel-default">
        <div class="panel-heading post-heading">

            <div class="media">
                <div class="media-right">
                    <a href="">
                        <img src="{{ asset('/img/persons/'.$post->user->avatar) }}" title="{{ $post->user->username }}" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('home.profile', $post->user->id) }}">{{ $post->user->username }}</a>
                    <span class="date" >شنبه 2 مهرماه 1395</span>
                </div>
            </div>

        </div>
        <div class="panel-body post-content">
            <div class="row">
                @if(!empty($post->image))
                    <div class="col-sm-4 pull-right  image">
                        <img src="{{ $post->image }}" class="img-rounded">
                    </div>
                    <div class="col-sm-8 pull-right">
                        <p>{{ $post->content }}</p>
                    </div>
                @else
                    <div class="col-sm-12 pull-right">
                        <p>{{ $post->content }}</p>
                    </div>
                @endif

            </div>
        </div>
        <div class="view-all-comments">
            <a href="#" class="pull-right">
                <i class="fa fa-comments-o"></i>
            </a>
            @if(count($post->comments))
                <span>{{ $post->num_comment }} دیدگاه</span>
            @else
                <span>اولین نفری باشد که دیدگاهتان را ثبت می کنید.</span>
            @endif
            <a href="{{route('profile.report.create',['type'=>'post','id'=>$post->id])}}" class="pull-left report-content">گزارش</a>
        </div>
        <ul class="comments" id="post_comments_list">
            <div class="list" data-nicescroll>
                @foreach($post->comments->reverse() as $comment)
                    @include('partials.postComment',[$post,$comment])
                @endforeach
            </div>
            <li class="comment-form">
                {!! Form::open(['route'=>['profile.post.comment.add', $post->id], 'data-remote-multiple', 'id'=>'insert_post_comment_form']) !!}
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