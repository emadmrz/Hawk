<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeading2" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2">تحصیلات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroup2" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
            <div class="panel-body" id="education_form">

                <div class="" data-role="preview">

                    <table class="table education-table" id="education_table_preview">
                        <thead>
                            <tr>
                                <th width="15%" >مقطع</th>
                                <th width="20%" >رشته تحصیلی</th>
                                <th width="15%" >وضعیت</th>
                                <th width="25%" >دانشگاه</th>
                                <th width="15%" >شروع</th>
                                <th width="15%" >اتمام</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educations as $education)
                                <tr data-education="{{ $education->id }}">
                                    <td>{{ $education->degree_name }}</td>
                                    <td>{{ $education->field }}</td>
                                    <td>{{ $education->status_name }}</td>
                                    <td>{{ $education->university->name }}</td>
                                    <td>{{ $education->entrance_year }}</td>
                                    <td>{{ $education->graduate_year }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-default btn-sm" data-role="edit" > <i class="fa fa-pencil"></i>  ویرایش  </button>

                </div>

                <div class="" data-role="editor" style="display: none">

                    <div class="panel panel-default new-education">
                        <div class="panel-heading title">
                            <h5>ثبت مقطع تحصیلی جدید</h5>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['url'=>'/profile/education', 'method'=>'post', 'data-remote', 'class'=>'form-horizontal panel-form']) !!}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('degree', 'مقطع : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('degree', $degrees,  null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('field', 'رشته : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('field', null, ['class'=>'form-control', 'placeholder'=>'رشته تحصیلی']) !!}
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('status', 'وضعیت : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('status', $statuses , null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('university_id', 'دانشگاه : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('university_id', $universities, null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('entrance_year', 'سال شروع : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('entrance_year', null, ['class'=>'form-control', 'placeholder'=>'مثلا 1387']) !!}
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('graduate_year', 'سال اتمام : ', ['class'=>'control-label pull-right']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('graduate_year', null, ['class'=>'form-control', 'placeholder'=>'مثلا 1392']) !!}
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class=" btn btn-success btn-sm "><i class="fa fa-plus"></i> افزودن مورد جدید </button>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="seprator"></div>

                    <table class="table education-table" id="education_table_edit">
                        <thead>
                        <tr>
                            <th width="15%" >مقطع</th>
                            <th width="20%">رشته تحصیلی</th>
                            <th width="15%"  >وضعیت</th>
                            <th width="20%" >دانشگاه</th>
                            <th width="10%">شروع</th>
                            <th width="10%">اتمام</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($educations as $education)
                            <tr data-education="{{ $education->id }}">
                                <td>{{ $education->degree_name }}</td>
                                <td>{{ $education->field }}</td>
                                <td>{{ $education->status_name }}</td>
                                <td>{{ $education->university->name }}</td>
                                <td>{{ $education->entrance_year }}</td>
                                <td>{{ $education->graduate_year }}</td>
                                <td>
                                    <form method="get">
                                        <input type='hidden' name='education_id' value="{{ $education->id }}" >
                                        <button type='submit' class=' btn btn-danger btn-xs' ><i class='fa fa-trash-o fa-lg' ></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-default" data-role="return" > <i class="fa fa-retweet"></i>  بازگشت  </button>


                </div>


            </div>
        </div>
        <div style="color: #666;font-size: 13px" class="panel-footer"><i class="fa fa-clock-o fa-lg" style="margin-left: 5px; top: 0"></i>
            آخرین ویرایش چهارشنبه 28 مرداد
        </div>
    </div>
</div>