@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                ویرایش اطلاعات فروشگاه
            </div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::model($shop, ['route'=>['profile.management.addon.shop.update',$shop->id], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
                <div class="clearfix form-horizontal">
                    @if(!empty($shop->logo))
                        <img src="{{ asset('img/files/shop/'.$shop->logo) }}" title="{{ $shop->logo }}" style="position: absolute; left: 60px">
                    @endif
                    <div class="form-group panel-form">
                        {!! Form::label('title', 'عنوان : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('logo_image', 'لوگو فروشگاه :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::file('logo_image', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('phone', 'تلفن : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('address', 'آدرس : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                        <div class="form-group panel-form">
                            {!! Form::label('theme', 'رنگ قالب : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('theme', $themes, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            </div>
                        </div>
                    <div class="form-group panel-form">
                        {!! Form::label('num_visit', 'تعداد بازدیدها :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            <div class="form-control-static">{{ $shop->num_visit }}</div>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        <div class="col-sm-12">
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'توضیحات مختصر مربوط به فروشگاه', 'rows'=>3]) !!}
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
                امکانات فروشگاه
            </div>
            <div class="panel-body">

                <section class="shop inpanel">
                    <div class="">
                        <div class="row">
                            <div class="shop-properties">
                                {!! Form::open(['route'=>['profile.management.addon.shop.advantage',$shop->id], 'method'=>'post']) !!}

                                @foreach($advantages as $advantage)
                                    <div class="col-md-2">
                                        <div class="property-item"><i class="fa {{ $advantage->logo }} fa-3x"></i>
                                            {{ $advantage->title }}
                                        </div>
                                        <div class="checkbox checkbox-success text-center">
                                            <input id="checkbox{{ $advantage->id }}" type="checkbox" name="advantage[]" value="{{ $advantage->id }}" @if(in_array($advantage->id, $shop_advantages)) checked @endif>
                                            <label for="checkbox{{ $advantage->id }}">{{ $advantage->title }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ثبت تغییرات </button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>


                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>

@endsection