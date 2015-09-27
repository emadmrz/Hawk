<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingHonor" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupHonor" aria-expanded="true" aria-controls="collapseListGroupHonor">
                ساعات ارائه مهارت
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupHonor" aria-labelledby="collapseListGroupHeadingHonor" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.schedule', $skill->id], 'method'=>'post', 'data-remote', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('week_day', 'روز هفته : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('week_day', $week_days, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('start_time', 'از ساعت : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-3 pull-right panel-form">
                        {!! Form::text('start_time', null, ['class'=>'form-control', 'placeholder'=>'مثلاً 08:00']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('end_time', 'تا ساعت :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-3 pull-right panel-form">
                        {!! Form::text('end_time', null, ['class'=>'form-control', 'placeholder'=>'مثلاً 15:00']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>



                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن ساعت ارائه مهارت </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="schedule_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >روز هفته</th>
                        <th  class="text-right" >از ساعت</th>
                        <th  class="text-right" >تا ساعت</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td width="35%"><a href="#" id="title" data-editable data-type="text" data-pk="{{ $schedule->id }}">{{ $schedule->title }}</a></td>
                            <td width="25%">{{ $schedule->day_name }}</td>
                            <td width="20%">{{ $schedule->start_time }}</td>
                            <td width="20%">{{ $schedule->end_time}}</td>
                            <td width="5%" ><button id="delete_schedule" data-value="{{ $schedule->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش شما می توانید ساعاتی از هفته که می توانید این مهارت را ارائه دهید بیان نمایید.
        </div>
    </div>
</div>