<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingBio" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupBio" aria-expanded="true" aria-controls="collapseListGroupBio" >
                @if($role == 'legal')
                    تاریخچه
                @else
                    بیوگرافی
                @endif
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupBio" aria-labelledby="collapseListGroupHeadingBio" aria-expanded="true">
            <div class="panel-body biopraphy">
                <div class="summernote" data-status="preview" >{!! $biography->text !!}</div>
                <div class="attachment" style="display: none;">
                    {!! Form::open(['url'=>'/files/uploader', 'id'=>'biography-attachment-form', 'class'=>'form-inline', 'enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                            <label for="aaa">انتخاب ضمیمه : </label>&ensp;
                            <input type="file" name="aaa" id="aaa" class="form-control">
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus" ></i> افزودن ضمیمه </button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="attachments-list">
                    @if(count($attachments) > 0)
                        <ul>
                            @foreach($attachments as $attachment)
                                <li><b id="delete_attachment" data-value="{{ $attachment->id }}" class="fa fa-times-circle" ></b><a target="_blank" href="{{ asset('img/files/'.$attachment->name) }}" >{{ $attachment->real_name }}</a><i class="fa fa-paperclip" ></i></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-footer share-buttons">
            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
            {{--<a href="#"><i class="fa fa-photo"></i></a>--}}
            {{--<a href="#"><i class="fa fa-video-camera"></i></a>--}}
            {{--<a href="#"><i class="fa fa-file"></i></a>--}}
            <button type="button" id="biography-toggle" onclick="edit()" class="btn btn-teal btn-xs pull-right display-none" ><i class="fa fa-pencil" ></i> ویرایش بیوگرافی </button>
            <button type="button" id="biography-cancel" onclick="cancel_edit()" style="display: none" class="btn btn-danger btn-xs pull-right display-none" ><i class="fa fa-times" ></i> انصراف و عدم ذخیره </button>
        </div>
    </div>
</div>