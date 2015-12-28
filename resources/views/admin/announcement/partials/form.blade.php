{!! Form::model($announcement,['route' => $route]) !!}
<div class="row">
    <div class="form-group">
        {!! Form::label('content','content :',['class'=>'control-label col-sm-1']) !!}
        <div class="col-sm-11">
            <div class="rtl" dir="rtl">
                {!! Form::textarea('content',null,['class'=>'form-control']) !!}
            </div><!-- /input-group -->
        </div>

    </div>
    <div class="form-group">
        {!! Form::label('expired_at','expire.Date',['class'=>'control-label col-sm-1']) !!}
        <div class="col-sm-11">
            {{--{!! Form::input('date','expired_at',Carbon\Carbon::now()->format('Y-m-d'),['class'=>'form-control']) !!}--}}
            <div class="input-group ltr">
                {!! Form::text('expired_at',null,['class'=>'input-small form-control ltr','id'=>'jalaliDatePicker1']) !!}
                <span class="input-group-btn">
                                <button id="jalaliDatePickerBtn1" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
            </div><!-- /input-group -->
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <div class="col-sm-2 pull-left col-sm-push-1">
            <button type="submit" class="btn btn-success form-control">{{$buttonName}}</button>
        </div>
    </div>
</div>
{!! Form::close() !!}