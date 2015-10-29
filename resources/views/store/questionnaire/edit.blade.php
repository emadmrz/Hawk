@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                ویرایش پرسشنامه
            </div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::model($questionnaire, ['route'=>['profile.management.addon.questionnaire.update',$questionnaire->id], 'method'=>'post', 'data-remote']) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('title', 'عنوان : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('main_category', 'دسته بندی سطح ۱ : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('main_category', $main_categories, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('category_id', ' دسته بندی سطح ۲ :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('category_id', $sub_categories, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tags_list[]', ' دسته بندی سطح ۳ :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-8 pull-right">
                            {!! Form::select('tags_list[]', $all_tags, null, ['class'=>'form-control', 'placeholder'=>'', 'id'=>'tags_list', 'multiple', 'dir'=>'rtl']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('count', 'تعداد پرسشنامه :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            <div class="form-control-static">{{ $questionnaire->count }}</div>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('show_result', ' نمایش نتیجه :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('show_result', [1=>'نمایش برای عموم', 0=>'عدم نمایش برای عموم'], null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        <div class="col-sm-12">
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'توضیحات مربوط به نظرسنجی برای نمایش به کاربران', 'rows'=>4]) !!}
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ثبت تغییرات </button>

                {!! Form::close() !!}

            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>

    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                افزودن پرسش و پاسخ
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.questionnaire.question.add',$questionnaire->id], 'method'=>'post', 'data-remote']) !!}
                    <div class="clearfix form-horizontal">
                        <div class="form-group panel-form">
                            {!! Form::label('title', 'پرسش :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('option[]', 'پاسخ 1 :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('option[]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('option[]', 'پاسخ 2 :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('option[]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('option[]', 'پاسخ 3 : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('option[]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('option[]', 'پاسخ 4 :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('option[]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <div class="form-group panel-form">
                            {!! Form::label('option[]', 'پاسخ 5 :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('option[]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> افزودن پارامتر </button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>


    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت پرسش ها و پاسخ ها
            </div>
            <div class="panel-body">
                <div id="questionnaire_questions_list" class="questionnaire_questions">
                    <ul>
                        @foreach($questionnaire->questions()->get() as $key=>$question)
                            <li>
                                <div class="numbering">{{ $key+1 }}</div>
                                <a data-editable id="title" data-type="text" data-pk="{{ $question->id }}" data-url="/profile/management/addon/questionnaire/question/update">{{$question->title}}</a>
                                <a id="delete_question" data-value="{{ $question->id }}" class="delete-question pull-left" href="#"><i class="fa fa-trash-o" ></i></a>
                                <ul>
                                    @foreach($question->options()->get() as $option)
                                        <li><i class="fa fa-circle-o" ></i><a data-editable id="name" data-type="text" data-pk="{{ $option->id }}" data-url="/profile/management/addon/questionnaire/question/update">{{ $option->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ route('profile.management.addon.questionnaire.publish',$questionnaire->id) }}" class="btn btn-success btn-block">انتشار پرسشنامه برای کاربران</a>
    </div>

    <p class="alert alert-warning">
        فراموش نکنید! پس از انتشار نظر سنجی در بین کاربران، امکان ویرایش مجدد نظر سنجی وجود ندارد. پس قبل از انتشار آن تمامی موارد را درنظر گرفته سپس نظر سنجی را منتشر نمایید.
    </p>
@endsection