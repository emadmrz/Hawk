<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingHonor" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupHonor" aria-expanded="true" aria-controls="collapseListGroupHonor">
                افتخارت و جوایز
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupHonor" aria-labelledby="collapseListGroupHeadingHonor" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.honor', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان افتخار :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'توضیحات افتخار :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sample_file', 'تصویر مرتبط : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن دستاورد یا افتخار  </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="honor_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >تصویر </th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($honors as $honor)
                        <tr>
                            <td width="25%"><a href="#" id="title" data-editable data-type="text" data-pk="{{ $honor->id }}">{{ $honor->title }}</a></td>
                            <td width="50%" ><a href="#" id="description" data-editable  data-type="textarea" data-pk="{{ $honor->id }}">{{ $honor->description }}</a></td>
                            <td width="15%" ><a target="_blank" href="{{ asset('img/files/'.$honor->files->first()['name']) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i> مشاهده تصویر </button></a></td>
                            <td width="5%" ><button id="delete_honor" data-value="{{ $honor->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش افتخارات و جوایز خود را که با این مهارت مرتبط هستند، به همراه تصویر وارد نمایید.
        </div>
    </div>
</div>