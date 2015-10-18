<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingDegrees" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupDegrees" aria-expanded="true" aria-controls="collapseListGroupDegrees">
                مدارک و گواهینامه ها
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupDegrees" aria-labelledby="collapseListGroupHeadingDegrees" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.degree', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان مدرک :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('creator', 'صادر کننده مدرک : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('creator', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('get_date', 'سال اخذ مدرک : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('get_date', $years_list, null, ['class'=>'form-control', 'data-select2']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('expiration_date', 'مدت اعتبار مدرک : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('expiration_date', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                {{--<div class="form-group">--}}
                    {{--{!! Form::label('description', 'توضیحات مدرک :', ['class'=>'col-md-2 pull-right form-control-static']) !!}--}}
                    {{--<div class="col-md-8 pull-right panel-form">--}}
                        {{--{!! Form::text('description', null, ['class'=>'form-control']) !!}--}}
                        {{--<i class="input-icon fa fa-edit"></i>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group">
                    {!! Form::label('sample_file', 'تصویر مدرک : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن مدرک یا گواهینامه  </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="degree_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >صادر کننده</th>
                        <th  class="text-right" >تاریخ اخذ</th>
                        <th  class="text-right" >مدت اعتبار</th>
                        {{--<th  class="text-right" >توضیحات</th>--}}
                        <th  class="text-right" >تصویر</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($degrees as $degree)
                        <tr>
                            <td width="30%" ><a href="#" id="title" data-editable data-type="text" data-pk="{{ $degree->id }}">{{ $degree->title }}</a></td>
                            <td width="20%" ><a href="#" id="creator" data-editable data-type="text" data-pk="{{ $degree->id }}">{{ $degree->creator }}</a></td>
                            <td width="20%" ><a href="#" id="get_date" data-editable data-type="text" data-pk="{{ $degree->id }}">{{ $degree->get_date }}</a></td>
                            <td width="20%" ><a href="#" id="expiration_date" data-editable data-type="text" data-pk="{{ $degree->id }}">{{ $degree->expiration_date }}</a></td>
                            {{--<td width="35%" ><a href="#" id="description" data-editable data-type="textarea" data-pk="{{ $degree->id }}">{{ $degree->description }}</a></td>--}}
                            <td width="10%" ><a target="_blank" href="{{ asset('img/files/'.$degree->files->first()['name']) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i>مشاهده</button></a></td>
                            <td width="5%" ><button id="delete_degree" data-value="{{ $degree->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش گواهینامه ها و مدارک دریافتی خود را که با این مهارت مرتبط هستند به همراه تصویر مدرک وارد نمایید.
        </div>
    </div>
</div>