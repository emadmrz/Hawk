<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingHistory" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupHistory" aria-expanded="true" aria-controls="collapseListGroupHistory">
                سوابق کاری
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupHistory" aria-labelledby="collapseListGroupHeadingHistory" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.history', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان سابقه کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('start_year', 'سال شروع فعالیت :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('start_year', $years_list, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('end_year', 'سال اتمام فعالیت :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('end_year', $years_list, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'ایمیل محل کار :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'تلفن محل کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('address', 'آدرس محل کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('address', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'توضیحات سابقه کار : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sample_file', 'تصویر سابقه کار :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن سابقه کار  </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="history_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >سال شروع</th>
                        <th  class="text-right" >سال اتمام</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >تصویر</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td width="20%" ><a href="#" data-editable id="title" data-type="text" data-pk="{{ $history->id }}">{{ $history->title }}</a></td>
                            <td width="10%" ><a href="#" data-editable id="start_year" data-type="number" data-pk="{{ $history->id }}">{{ $history->start_year }}</a></td>
                            <td width="10%" ><a href="#" data-editable id="end_year" data-type="number" data-pk="{{ $history->id }}">{{ $history->end_year }}</a></td>
                            <td width="40%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="{{ $history->id }}">{{ $history->description }}</a></td>
                            @if(count($history->files)>0)
                                <td width="15%" ><a target="_blank" href="{{ asset('img/files/'.$history->files->first()['name']) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i> مشاهده تصویر </button></a></td>
                            @else
                                <td width="15%" ></td>
                            @endif
                            <td width="5%" ><button id="delete_history" data-value="{{ $history->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش شما می توانید سوابق کاری خود را با ذکر مشخصات کامل محل کار، توضیحات و تصویر مرتبط وارد نمایید.
        </div>
    </div>
</div>