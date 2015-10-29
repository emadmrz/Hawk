@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">تصاویر و بنر فروشگاه</div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::open(['route'=>['profile.management.addon.shop.images.store',$shop->id], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
                <div class="clearfix form-horizontal">

                    <div class="form-group panel-form">
                        {!! Form::label('inputImage', 'تصویر بنر فروشگاه : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <input type="hidden" name="cropper_json" id="cropper_json" value="">
                        <div class="col-sm-4">
                            {!! Form::file('inputImage', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div id="crop_image_preview"><img src="{{ asset('img/cover/slider1.jpg') }}"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> افزودن تصویر فروشگاه </button>


                </div>
                {!! Form::close() !!}
                <br>
                <div class="col-sm-6 pull-right clearfix">
                    <table class="table table-striped text-right editable-table" id="shop_banner_table_list">
                        <thead>
                        <tr>
                            <th class="text-right" >تصویر بنر فروشگاه</th>
                            <th class="text-right" >عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shop->files()->get() as $file)
                            <tr>
                                <td width="95%"><a target="_blank" href="{{ asset('img/files/shop/'.$file->name) }}">{{ $file->real_name }}</a></td>
                                <td width="5%"><button id="delete_shop_banner" data-value="{{ $file->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

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