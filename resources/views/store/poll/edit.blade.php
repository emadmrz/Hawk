@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                ویرایش نظر سنجی
            </div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::model($poll, ['route'=>['profile.management.addon.poll.update',$poll->id], 'method'=>'post', 'data-remote']) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('title', 'عنوان : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('question', 'پرسش نظر سنجی :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('question', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('main_category', 'دسته بندی سطح ۱ : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('main_category', $main_categories, null, ['id'=>'category_id','class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('category_id', ' دسته بندی سطح ۲ :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('category_id', $sub_categories, null, ['id'=>'sub_category_id','class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tags_list[]', ' دسته بندی سطح ۳ :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-8 pull-right">
                            {!! Form::select('tags_list[]', $all_tags, null, ['class'=>'form-control', 'placeholder'=>'', 'id'=>'tags_list', 'multiple', 'dir'=>'rtl']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('show_result', 'ارسال برای :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            <div class="form-control-static">دوستان</div>
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
                پارامترهای نظرسنجی
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.poll.parameter.add',$poll->id], 'method'=>'post', 'data-remote']) !!}
                    <div class="clearfix form-horizontal">
                        <div class="form-group panel-form">
                            {!! Form::label('name', 'عنوان پارامتر :', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> افزودن پارامتر </button>
                        </div>
                    </div>
                {!! Form::close() !!}
                <table class="table table-bordered table-striped" id="parameter_table_list">
                    <thead>
                        <tr>
                            <th class="text-right">عنوان پارامتر</th>
                            <th class="text-right">جذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $poll->parameters()->latest()->get() as $parameter)
                            <tr>
                                <td><a href="#" data-editable id="name" data-type="text" data-pk="{{ $parameter->id }}">{{ $parameter->name }}</a></td>
                                <td width="5%" ><button id="delete_parameter" data-value="{{ $parameter->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ route('profile.management.addon.poll.select',$poll->id) }}" class="btn btn-success btn-block">انتخاب دریافت کنندگان نظرسنجی</a>
    </div>

    <p class="alert alert-warning">
        فراموش نکنید! پس از انتشار نظر سنجی در بین کاربران، امکان ویرایش مجدد نظر سنجی وجود ندارد. پس قبل از انتشار آن تمامی موارد را درنظر گرفته سپس نظر سنجی را منتشر نمایید.
    </p>
@endsection