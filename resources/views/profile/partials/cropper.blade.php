<!-- Cropping modal -->
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form class="avatar-form" action="{{url('profile/cover')}}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" ></i></button>
                    <h4 class="modal-title" id="avatar-modal-label">انتخاب عکس</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <label for="avatarInput"><a href="#" > راهنمای آپلود عکس</a></label>
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div class="{{ ($type=='avatar') ? 'col-md-9' : 'col-md-12' }}">
                                <div class="avatar-wrapper"></div>
                            </div>
                            @if($type == 'avatar')
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            @endif
                        </div>

                        <div class="row avatar-btns">
                            <div class="col-md-12">
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-violet" data-method="rotate" data-option="15" title="Rotate 15 degrees">
                                        <i class="fa fa-rotate-right" data-method="rotate" data-option="15" ></i>
                                    </button>
                                    <button type="button" class="btn btn-violet" data-method="rotate" data-option="90">
                                        <i class="fa icon-turn-right" data-method="rotate" data-option="90" ></i>
                                    </button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-violet" data-method="rotate" data-option="-90">
                                        <i class="fa icon-turn-left" data-method="rotate" data-option="-90" ></i>
                                    </button>
                                    <button type="button" class="btn btn-violet" data-method="rotate" data-option="-15" title="Rotate -15 degrees">
                                        <i class="fa fa-rotate-left" data-method="rotate" data-option="-15" ></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-violet avatar-save">برش و ذخیره عکس</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<!-- Loading state -->
<div class="loading cropper" aria-label="Loading" role="img" tabindex="-1"></div>