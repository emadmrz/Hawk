<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingHonor" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupArea" aria-expanded="true" aria-controls="collapseListGroupArea">
                محل ارائه مهارت
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupArea" aria-labelledby="collapseListGroupHeadingArea" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.area', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('province_id', 'انتخاب استان : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-3 pull-right panel-form">
                        {!! Form::select('province_id', $provinces  ,null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('city_id', 'انتخاب شهر :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-3 pull-right panel-form">
                        {!! Form::select('city_id', $cities, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'توضیحات :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن محل ارائه مهارت </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="area_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >استان</th>
                        <th  class="text-right" >شهر</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($areas as $area)
                        <tr>
                            <td width="25%">{{ $area->city->getRoot()->name }}</td>
                            <td width="25%">{{ $area->city->name }}</td>
                            <td width="45%" ><a href="#" id="description" data-editable  data-type="textarea" data-pk="{{ $area->id }}">{{ $area->description }}</a></td>
                            <td width="5%" ><button id="delete_area" data-value="{{ $area->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <div class="info"><i class="fa icon-information" ></i>در این بخش استان و شهرهایی که می توانید مهارت خود را ارائه دهید با ذکر توضیحات بیان نمایید.</div>
        </div>
    </div>
</div>