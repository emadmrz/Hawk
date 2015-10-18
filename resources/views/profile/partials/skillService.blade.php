<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingService" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupService" aria-expanded="true" aria-controls="collapseListGroupService">
                امکانات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupService" aria-labelledby="collapseListGroupHeadingService" aria-expanded="false">
            <div class="panel-body" id="add_service_form">
                {!! Form::open(['route'=>['profile.skill.add.service', $skill->id], 'method'=>'post', 'data-remote', 'class'=>'form-horizontal']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان امکانات : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('title', $services_list, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div id="manual_service" style="display: none">
                    <div class="form-group">
                        {!! Form::label('other_title', 'عنوان امکانات : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                        <div class="col-md-4 pull-right panel-form">
                            {!! Form::text('other_title', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('description', 'توضیحات  :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> ثبت امکانات </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="service_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان امکانات</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td width="25%"><a href="#" id="title" data-editable  data-type="text" data-pk="{{ $service->id }}">{{ $service->title }}</a></td>
                            <td width="70%" ><a href="#" id="description" data-editable  data-type="textarea" data-pk="{{ $service->id }}">{{ $service->description }}</a></td>
                            <td width="5%" ><button id="delete_service" data-value="{{ $service->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش می توایند امکانات مجموعه خود را انتخاب نمایید.
        </div>
    </div>
</div>