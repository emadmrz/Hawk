@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">ارتباط با ما</div>
            <div class="panel-body  biopraphy article">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::model($shop, ['route'=>['profile.management.addon.shop.contactus.update',$shop->id], 'method'=>'post']) !!}
                    {!! Form::textarea('contact_us', null, ['class'=>'form-control textarea_summernote', 'rows'=>'10']) !!}

                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ثبت تغییرات </button>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>

@endsection