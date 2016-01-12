@extends('profile.layout')
@section('side')
    @include('store.recruitment.partials.recruitmentManagementMenu')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                ثبت آگهی
            </div>
            <div class="panel-body">
                {!! Form::model($recruitment,['route'=>['profile.management.addon.recruitment.job.create',$recruitment->id],'files'=>true]) !!}
                <input type="hidden" name="cropper_json" id="cropper_json" value="">
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('group_title','عنوان مجموعه :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('group_title',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_title','عنوان شغل :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_title',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_description','شرح شغل :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_description',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_responsibility','مسئولیت و وظایف :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_responsibility',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_condition','شرایط احراز :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_condition',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_office','محل کار :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_office',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('job_style','شرایط کار :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('job_style',null,['class'=>'form-control']) !!}
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
                            {!! Form::select('tags_list[]', $all_tags, null, ['class'=>'form-control', 'id'=>'select_tags', 'multiple'=>'multiple', 'dir'=>'rtl']) !!}
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('image','لوگو :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::file('image', ['id'=>'inputImage']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            @if(!$recruitment->image)
                                <div id="crop_image_preview"><img src="{{ asset('img/cover/offer_preview.jpg') }}"></div>
                            @else
                                <div id="crop_image_preview"><img src="{{ asset('img/files') }}/{{$recruitment->image}}"></div>
                            @endif
                        </div>
                    </div>



                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>ثبت آگهی</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>



@endsection

@section('script')

    <script>
        $(document).ready(function() {




            // Import image
            var $image = $('#crop_image_preview > img');
            $image.cropper({
                aspectRatio: 851 / 360,
                autoCropArea: 0.8,
                guides: false,
                dragCrop: false,
                crop: function (e) {
                    var json = [
                        '{"x":' + e.x,
                        '"y":' + e.y,
                        '"height":' + e.height,
                        '"width":' + e.width,
                        '"rotate":' + e.rotate + '}'
                    ].join();

                    $("#cropper_json").val(json);
                }
            });
            var $inputImage = $('#inputImage');
            var URL = window.URL || window.webkitURL;
            var blobURL;

            if (URL) {
                $inputImage.change(function () {
                    var files = this.files;
                    var file;

                    if (!$image.data('cropper')) {
                        return;
                    }

                    if (files && files.length) {
                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            blobURL = URL.createObjectURL(file);
                            $image.one('built.cropper', function () {
                                URL.revokeObjectURL(blobURL); // Revoke when load complete
                            }).cropper('reset').cropper('replace', blobURL);
                        } else {
//                        $body.tooltip('Please choose an image file.', 'warning');
                        }
                    }
                });
            } else {
                $inputImage.prop('disabled', true).parent().addClass('disabled');
            }

        });

    </script>

@endsection