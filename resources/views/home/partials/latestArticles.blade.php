<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            آخرین مقالات
        </div>
        <div class="panel-body">
            <div class="list-item-image">
                <ul class="">
                    @foreach($user->articles as $article)
                    <li>
                        <div class="media">
                            <div class="media-right">
                                <a href="{{ route('home.article.preview', [$user->id, $article->id]) }}"><img class="media-object img-rounded" src="{{ asset('img/files/'.$article->thumbnail ) }}" alt="sss"></a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading"><a href="{{ route('home.article.preview', [$user->id, $article->id]) }}"> {{ $article->title }}</a></div>
                                <div class="date">{{ $article->shamsi_created_at }}</div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer text-center">
            <a class="see-more" href="{{ route('home.articles', [$user->id]) }}"><i class="fa fa-plus fa-1x"></i>مشاهده سایر مقالات</a>
        </div>
    </div>
</div>