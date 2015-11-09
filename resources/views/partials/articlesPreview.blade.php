<div class="timeline-block" id="add_new_post">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            {{ $article->title }}
        </div>
        <div class="panel-body">
            <div class="article_show">
                @if(!empty($article->banner))
                    <div class="image">
                        <img src="{{ asset('img/files/'.$article->banner) }}">
                    </div>
                @endif
                <div class="info">
                    <ul>
                        <li><i class="fa icon-user-1 fa-lg"></i>فرستنده : <a href="#">{{ $article->user->first_name  }} {{ $article->user->last_name  }}</a></li>
                        <li><i class="fa icon-calendar-1 fa-lg"></i>{{ $article->shamsi_created_at }}</li>
                        <li><i class="fa icon-user-2 fa-lg"></i> {{ $article->num_visit }} بازید </li>
                        <li><i class="fa icon-comment-2 fa-lg"></i> {{ $article->num_comment }} دیدگاه </li>
                        <li class="@if($article->liked($user->id)) liked-heart @endif" ><i class="fa @if($article->liked($user->id)) icon-heart-fill @else icon-heart @endif fa-lg" id="article_like" data-article="{{ $article->id }}" data-value="1"></i><span id="num_like" >{{ $article->num_like }}</span> نفر پسندیده اند </li>
                    </ul>
                </div>
                <div class="content">{!! $article->content !!}</div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-left last-edit"> آخرین ویرایش  {{ $article->shamsi_updated_at }} </div>
            <a class="btn btn-warning" href="{{route('profile.report.create',['type'=>'article','id'=>$article->id])}}">گزارش</a>
            @if($canEdit)
            <a class="btn btn-info btn-sm" href="{{ route('profile.article.edit', $article->id ) }}"><i class="fa fa-pencil" ></i> ویرایش مقاله </a>
            <a class="btn btn-default btn-sm" href="{{ route('profile.article.create' ) }}"><i class="fa fa-plus" ></i> افزودن مقاله جدید </a>
            @endif
        </div>
    </div>
</div>

<div class="comment-list">
    @if(Auth::check())
    <div class="new-comment">

        {!! Form::open(['route'=>['profile.article.comment.add', $article->id], 'method'=>'post']) !!}
            <div class="media">
                <div class="media-right">
                    <a href="#">
                        <img class="media-object" src="{{asset('img/persons/'.$user->avatar)}}" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <textarea name="body" placeholder="شما هم می توانید دیدگاه خود را درباره این مقاله بیان نمایید."></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-paper-plane-o"></i> ثبت دیدگاه </button>
        {!! Form::close() !!}<hr>

    </div>
    @endif
    <div class="comments">

        @foreach($article->comments as $comment)
        <div class="media">
            <div class="media-right">
                <a href="#">
                    <img class="media-object" src="{{asset('img/persons/'.$comment->user->avatar)}}" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h5 class="media-heading"><a href="#">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a><span class="info">{{ $comment->shamsi_human_created_at }}</span></h5>
                <p>{{ $comment->body }}</p>
            </div>
        </div>
        @endforeach


    </div>

</div>
