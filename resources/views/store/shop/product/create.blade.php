@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    @if($for == 'edit')
        @include('store.shop.product.steps',['step'=>1])
    @endif
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                @if($for == 'create')
                    ثبت کالای جدید
                @elseif($for == 'edit')
                    ویرایش کالا
                @endif
            </div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                @if($for == 'create')
                    {!! Form::open(['route'=>['profile.management.addon.shop.product.store',$shop->id], 'method'=>'post']) !!}
                @elseif($for == 'edit')
                    {!! Form::model($product, ['route'=>['profile.management.addon.shop.product.update',$shop->id, $product->id], 'method'=>'post']) !!}
                @endif
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('name', 'عنوان : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('skill_id', 'مهارت مرتبط : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('skill_id', $skills, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('main_category', 'دسته بندی سطح 1 :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('main_category', $main_categories, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('category_id', 'دسته بندی سطح 2 :', ['class'=>'control-label pull-right col-sm-2']) !!}
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
                        {!! Form::label('price', 'قیمت (تومان) : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('discount', 'تخفیف (درصد) :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('discount', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('guarantee', 'گارانتی : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('guarantee', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('warranty', 'شرایط برگشت کالا : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('warranty', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group  panel-form">
                        {!! Form::label('weight', 'وزن کالا (کیلوگرم) : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-2 pull-right">
                            {!! Form::input('number', 'weight', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group  panel-form">
                        {!! Form::label('available', 'وضعیت کالا :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3 pull-right">
                            {!! Form::select('available',[0=>'ناموجود', 1=>'موجود'] , null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>

                    <div class="form-group  panel-form">
                        {!! Form::label('status', 'نمایش کالا', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3 pull-right">
                            {!! Form::select('status',[0=>'خیر', 1=>'بله'] , null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        <div class="col-sm-12">
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'توضیحات مرتبط با کالا', 'rows'=>3]) !!}
                        </div>
                    </div>
                </div>
                @if($for == 'create')
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>افزودن کالا و ادامه به مرحله بعد</button>
                @elseif($for == 'edit')
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ثبت تغییرات </button>
                    <a href="{{ route('profile.management.addon.shop.product.edit.step2', [$shop->id, $product->id]) }}" class="btn btn-default"><i class="fa fa-times"></i> عدم ذخیره و ادامه </a>
                @endif

                {!! Form::close() !!}

            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>


@endsection