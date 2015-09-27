<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingExperience" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupExperience" aria-expanded="true" aria-controls="collapseListGroupExperience">
                نمونه کارها
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupExperience" aria-labelledby="collapseListGroupHeadingExperience" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.experience', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان نمونه کار :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'توضیحات نمونه کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sample_file', 'فایل نمونه کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن نمونه کار </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="experience_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >فایل نمونه کار</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($experiences as $experience)
                        <tr>
                            <td width="30%" ><a href="#" data-editable id="title" data-type="text" data-pk="{{ $experience->id }}">{{ $experience->title }}</a></td>
                            <td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="{{ $experience->id }}">{{ $experience->description }}</a></td>
                            <td width="15%" ><a target="_blank" href="{{ asset('img/files/'.$experience->files->first()['name']) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i> مشاهده فایل </button></a></td>
                            <td width="5%" ><button id="delete_experience" data-value="{{ $experience->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
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