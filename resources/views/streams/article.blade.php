<div class="timeline-block">
    <div class="panel panel-default">
        <div class="panel-heading post-heading">
            <div class="media">
                <div class="media-right">
                    <a href="{{ route('home.article.preview', [$article->user->id, $article->id]) }}">
                        <img src="{{ asset('/img/persons/'.$article->user->avatar) }}" title="{{ $article->user->username }}" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('home.profile', $article->user->id) }}">{{ $article->user->username }}</a>
                    <span class="date" >{{ $article->shamsi_created_at }}</span>
                </div>
            </div>
        </div>
        <div class="panel-body articles-list stream">

            <article>
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <div class="image">
                            <img src="{{ asset('img/files/'.$article->thumbnail) }}" title="{{ $article->title }}" >
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <h3><a href="{{ route('home.article.preview', [$article->user->id, $article->id]) }}" >{{ $article->title }}</a></h3>
                        <div class="content">
                            {!! str_limit( $article->content ,500, '...') !!}
                        </div>
                    </div>
                </div>
                <div class="social-icons icon-rounded">
                    <ul>
                        <li><a href="{{ route('share.article',['article'=>$article->id, 'social'=>'facebook']) }}" ><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ route('share.article',['article'=>$article->id, 'social'=>'twitter']) }}" ><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{ route('share.article',['article'=>$article->id, 'social'=>'gmail']) }}" ><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="{{ route('share.article',['article'=>$article->id, 'social'=>'linkedin']) }}" ><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="actions">
                    <a href="{{ route('home.article.preview', [$article->user->id, $article->id]) }}" ><button class="btn-violet btn btn-sm">مطالعه ادامه مطلب</button></a>
                </div>
            </article>
            <div class="info-bar">
                <ul>
                    <li><i class="fa icon-user-1"></i> <span>ارسال شده توسط : </span> <a href="{{ route('home.profile', $article->user->id) }}" >{{ $article->user->username  }} </a> </li>
                    <li><i class="fa icon-calendar-1"></i> <span>تاریخ : </span> {{ $article->shamsi_created_at }}  </li>
                    <li><i class="fa icon-comment-2"></i>  دیدگاه ( {{ $article->num_comment  }} )  </li>
                    <li><i class="fa icon-visual-eye"></i>  بازدید ( {{ $article->num_visit  }} ) </li>
                    <li><i class="fa icon-heart"></i>{{ $article->num_like }} نفر پسندیده اند </li>
                </ul>
            </div>

        </div>
    </div>
</div>