@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection
@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">ایجاد گروه</div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.group.store'], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('name','نام گروه :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('inputBanner','تصویر بنر گروه :', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <input type="hidden" name="cropper_json" id="cropper_json" value="">
                        <div class="col-sm-4">
                            {!! Form::file('inputBanner', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div id="crop_image_preview"><img src="{{ asset('img/cover/slider1.jpg') }}"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>ایجاد گروه </button>


                </div>
                {!! Form::close() !!}
                <br>

            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            // Import image
            var $image = $('#crop_image_preview > img');
            $image.cropper({
                aspectRatio: 24.3 / 9,
                autoCropArea: 0.65,
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
            var $inputImage = $('#inputBanner');
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