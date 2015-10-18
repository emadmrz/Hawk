<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
لیست پست های من
        </div>
        <div class="panel-body" id="friendship_list">
            <div class="articles-list">
                @foreach($posts as $post)
                    <article>
                        <div class="row">
                            @if(!empty($post->image))
                                <div class="col-md-3 pull-right">
                                    <div class="image">
                                        <img src="{{ $post->image }}" title="" >
                                    </div>
                                </div>
                            @endif
                            <div class="@if(!empty($post->image)) col-md-9 @else col-md-12 @endif pull-right">
                                <div class="info-bar">
                                    <ul>
                                        <li><span>ارسال شده توسط : </span> <a href="#" >{{ $post->user->username}} </a></li>
                                        <li><span>تاریخ : </span> {{ $post->shamsi_created_at }} </li>
                                        <li><a href="#" > دیدگاه ( {{ $post->num_comment  }} ) </a></li>
                                    </ul>
                                </div>
                                <div class="content">
                                    {!! str_limit( $post->content ,500, '...') !!}
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
                        <div class="actions" @if(empty($post->image)) style="right:0" @endif>
                            <a href="@if($canEdit) {{ route('profile.post.preview', ['post'=>$post->id]) }} @else {{ route('home.post.preview', [$user->id, $post->id]) }}  @endif" ><button class="btn-violet btn btn-sm">مطالعه ادامه مطلب</button></a>
                            @if($canEdit)

                                    {!! Form::open( ['route'=>['profile.post.delete',$post->id], 'method'=>'delete', 'style'=>'display:inline'] ) !!}
                                        <button type="submit" class="btn-danger btn btn-sm">حذف پست</button>
                                    {!! Form::close() !!}

                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center ltr">{!! $posts->render() !!}</div>

        </div>
    </div>
</div>
