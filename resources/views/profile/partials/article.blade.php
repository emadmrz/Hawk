<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingBio" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupBio" aria-expanded="true" aria-controls="collapseListGroupBio" >
                @if( $for == 'create' )
                    ثبت مقاله جدید
                @elseif($for == 'edit')
                    ویرایش اطلاعات مقاله
                @endif
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupBio" aria-labelledby="collapseListGroupHeadingBio" aria-expanded="true">
            <div class="panel-body biopraphy article">
                @if( $for == 'create' )
                    <p>
                       در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                    {!! Form::open(['route'=>'profile.article.add', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                @elseif($for == 'edit')
                    {!! Form::model($article, ['route'=>['profile.article.update',$article->id], 'method'=>'put', 'enctype'=>'multipart/form-data', 'id'=>'article_edit_form']) !!}
                    <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
                @endif
                    <div class="clearfix form-horizontal">
                        <div class="form-group panel-form">
                            {!! Form::label('title', 'عنوان مقاله : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('status', ' وضعیت : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('status', [1=>'منتشر شود', 0=>'منتشر نشود'], null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            </div>
                        </div>
                        @if($for == 'edit')
                            <div class="form-group panel-form">
                                {!! Form::label('article_banner', ' تصویر بالای مقاله : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                                {!! Form::File('article_banner', ['class'=>'pull-right col-sm-4']) !!}
                                <span class="inline-loader" id="article_banner_uploader"><i class="fa fa-spinner fa-spin" ></i> در حال آپلود ... </span>
                                <a target="_blank" href="{{asset('img/files/'.$article->banner)}}" id="article_image_banner" @if(empty($article->banner))style="display: none"@endif ><button type="button" data class="btn btn-default btn-sm" >مشاهده عکس مقاله</button></a>
                            </div>
                        @endif
                    </div>

                    @if($for == 'edit')
                        {!! Form::textarea('content', null, ['class'=>'form-control article_summernote', 'rows'=>'10']) !!}
                        <div class="form-group">
                            {!! Form::textarea('keywords', null, ['class'=>'form-control', 'rows'=>'5', 'placeholder'=>"کلمات کلیدی مقاله برای بهبود جستجو در سایت و توسط موتور های جستجو، کلمات کلیدی را با - از هم جدا نمایید."]) !!}
                        </div>
                    @endif

                    @if( $for == 'create' )
                        <button type="submit" class="btn btn-success">ثبت و ادامه</button>
                    @endif

                {!! Form::close() !!}

                    @if( $for == 'edit' )

                        <div class="attachment" style="margin-bottom: 15px">
                            {!! Form::open(['url'=>'/files/uploader', 'id'=>'article-attachment-form', 'class'=>'form-inline', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="aaa">انتخاب ضمیمه : </label>&ensp;
                                <input type="file" name="aaa" id="aaa" class="form-control input-sm">
                                <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-plus" ></i> افزودن ضمیمه </button>
                            </div>
                            {!! Form::close() !!}
                            <div class="attachments-list">
                                <ul>
                                    @foreach($attachments as $attachment)
                                        <li><b id="delete_attachment" data-value="{{ $attachment->id }}" class="fa fa-times-circle" ></b><a target="_blank" href="{{ asset('img/files/'.$attachment->name) }}" >{{ $attachment->real_name }}</a><i class="fa fa-paperclip" ></i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <button id="article_edit_form_submit" type="button" class="btn btn-success">ذخیره کردن تغییرات</button>
                        <a href="{{ route('profile.articles') }}" ><button type="button" class="btn btn-default">عدم ذخیره و بازگشت</button></a>
                        {!! Form::open(['route'=>['profile.article.delete',$article->id] , 'method'=>'delete', 'class'=>'form-inline pull-left']) !!}
                            {!! Form::button('حذف مقاله', ['class'=>'btn btn-danger pull-left', 'type'=>'submit', 'data-delete-confirm', 'data-delete-message'=>'آیا مطمئن هستید این مقاله حذف شود ؟']) !!}
                        {!! Form::close() !!}

                    @endif

            </div>
        </div>
        {{--<div class="panel-footer share-buttons">--}}
            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
            {{--<a href="#"><i class="fa fa-photo"></i></a>--}}
            {{--<a href="#"><i class="fa fa-video-camera"></i></a>--}}
            {{--<a href="#"><i class="fa fa-file"></i></a>--}}
            {{--<button type="button" id="biography-toggle" onclick="edit()" class="btn btn-teal btn-xs pull-right display-none" ><i class="fa fa-pencil" ></i> ویرایش بیوگرافی </button>--}}
        {{--</div>--}}
    </div>
</div>

@if( $for == 'edit' )
<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingDiagram" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupDiagram" aria-expanded="true" aria-controls="collapseListGroupDiagram" >
                نمودار آماری بازدید از مقاله
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupDiagram" aria-labelledby="collapseListGroupHeadingDiagram" aria-expanded="true">
            <div class="panel-body">
                <div id="articleVisitorDiagram" style="height: 250px;"></div>
            </div>
        </div>
        {{--<div class="panel-footer info">--}}

        {{--</div>--}}
    </div>
</div>


@section('script')
    <link href="{{ asset('css/admin/morris.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin/raphael-min.js') }}"></script>
    <script src="{{ asset('js/admin/morris.min.js') }}"></script>
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'articleVisitorDiagram',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                @foreach($visitDiagramInfo as $date=>$value)
                {day: '{{$date}}', value: {{$value}} },
                @endforeach
        ],
            // The name of the data record attribute that contains x-values.
            xkey: 'day',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['visit']
        });
    </script>

@endsection

@endif