<div class="article-preview">
    <article>
        <h3>
            {{ $article->title }}
        </h3>
        <div class="info-bar">
            <ul>
                <li><span>ارسال شده توسط : </span> <a href="#" >{{ $article->user->first_name  }} {{ $article->user->last_name  }} </a></li>
                <li><span>ناریخ : </span> {{ $article->shamsi_created_at }} </li>
                <li><a href="#" > دیدگاه ( {{ $article->num_comment  }} ) </a></li>
            </ul>
        </div>
        @if(!empty($article->banner))
            <div class="image">
                <img src="{{ asset('img/files/'.$article->banner) }}">
            </div>
        @endif
        <div class="content">
            {!! $article->content !!}
        </div>
        @if(count($attachments)>0)
            <div class="attachments-list">
                <span>ضمیمه های مقاله : </span>
                <ul>
                    @foreach($attachments as $attachment)
                        <li><a target="_blank" href="{{ asset('img/files/'.$attachment->name) }}" >{{ $attachment->real_name }}</a><i class="fa fa-paperclip" ></i></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="statics clearfix">
            <div class="num-comments pull-right"><i class="fa fa-comments-o" ></i>  دیدگاه ( {{ $article->num_comment  }} )  </div>
            <div class="num-like pull-left"><i class="fa fa-heart" ></i>  می پسندم ( {{ $article->num_like  }} )  </div>
            <div class="num-visit pull-left"><i class="fa fa-eye" ></i>  بازدید  ( {{ $article->num_visit  }} )  </div>
        </div>

    </article>

        <div class="commenting">
            <textarea class="form-control" rows="4"></textarea>
            <button class="btn-violet btn">ثبت دیدگاه</button>

            <div class="comments-list">

                <div class="media">
                    <div class="media-right">
                        <a href="#" class="thumbnail">
                            <img class="media-object" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="aaaa">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="panel panel-default comment">
                            <div class="panel-heading">
                                <span class="text-muted">commented 5 days ago</span><strong>myusername</strong>
                            </div>
                            <div class="panel-body">
                                Panel content
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div>
                </div>

            </div>



        </div>

</div>