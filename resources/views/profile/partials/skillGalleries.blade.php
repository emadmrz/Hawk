<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingGallery" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupGallery" aria-expanded="true" aria-controls="collapseListGroupGallery">
                گالری تصاویر
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupGallery" aria-labelledby="collapseListGroupHeadingGallery" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.gallery', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان تصویر : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('sample_file', 'انتخاب تصویر : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i>افزودن تصویر به گالری</button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="gallery_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >تصویر گالری</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($galleries as $gallery)
                        <tr>
                            <td width="50%" ><a href="#" data-editable id="title" data-type="text" data-pk="{{ $gallery->id }}">{{ $gallery->title }}</a></td>
                            <td width="15%" ><a target="_blank" href="{{ asset('img/files/'.$gallery->files->first()['name']) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i> مشاهده تصویر </button></a></td>
                            <td width="5%" ><button id="delete_gallery" data-value="{{ $gallery->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش شما می توانید تصویر ، فیلم و یا متنی از نمونه کار خود که با این مهارت مرتبط می باشد، با ذکر توضیحات وارد نمایید.
        </div>
    </div>
</div>