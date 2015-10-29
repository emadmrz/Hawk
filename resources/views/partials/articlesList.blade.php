<div class="articles-list">
    @foreach($articles as $article)
        <article>
            <div class="row">
                <div class="col-md-3 pull-right">
                    <div class="image">
                        <img src="{{ asset('img/files/'.$article->thumbnail) }}" title="{{ $article->title }}" >
                    </div>
                </div>
                <div class="col-md-9 pull-right">
                    <div class="info-bar">
                        <ul>
                            <li><span>ارسال شده توسط : </span> <a href="#" >{{ $article->user->first_name  }} {{ $article->user->last_name  }} </a></li>
                            <li><span>تاریخ : </span> {{ $article->shamsi_created_at }} </li>
                            <li><a href="#" > دیدگاه ( {{ $article->num_comment  }} ) </a></li>
                        </ul>
                    </div>
                    <h3><a href="#" >{{ $article->title }}</a></h3>
                    <div class="content">
                        {!! str_limit( $article->content ,500, '...') !!}
                    </div>
                </div>
            </div>
            <div class="social-icons icon-rounded">
                <ul>
                    <li><a href="#" ><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" ><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" ><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" ><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="actions">
                <a href="@if($canEdit) {{ route('profile.article.preview', ['article'=>$article->id]) }} @else {{ route('home.article.preview', [$user->id, $article->id]) }}  @endif" ><button class="btn-violet btn btn-sm">مطالعه ادامه مطلب</button></a>
                @if($canEdit)
                    <a href="{{ route('profile.article.edit', ['article'=>$article->id]) }}" ><button class="btn-success btn btn-sm">ویرایش</button></a>
                @endif
            </div>
        </article>
    @endforeach
</div>

<div class="text-center ltr">{!! $articles->render() !!}</div>

