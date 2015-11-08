@extends('admin.layout')

@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Set Settlement Period
            </div>

            <div class="panel-body">

                {!! Form::open(['route' => ['admin.settle.store']]) !!}
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('from_time','From :',['class'=>'control-label col-sm-1']) !!}
                        <div class="col-sm-11">
                            {{--{!! Form::input('date','expired_at',Carbon\Carbon::now()->format('Y-m-d'),['class'=>'form-control']) !!}--}}
                            <div class="input-group ltr">
                                <input name="from_time" id="jalaliDatePicker" class="input-small form-control ltr" type="text">
                            <span class="input-group-btn">
                                <button id="jalaliDatePickerBtn" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            </div><!-- /input-group -->
                        </div>

                    </div>
                    <div class="form-group">
                        {!! Form::label('to_time','To :',['class'=>'control-label col-sm-1']) !!}
                        <div class="col-sm-11">
                            {{--{!! Form::input('date','expired_at',Carbon\Carbon::now()->format('Y-m-d'),['class'=>'form-control']) !!}--}}
                            <div class="input-group ltr">
                                <input name="to_time" id="jalaliDatePicker1" class="input-small form-control ltr" type="text">
                            <span class="input-group-btn">
                                <button id="jalaliDatePickerBtn1" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            </div><!-- /input-group -->
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-2 pull-left col-sm-push-1">
                            <button type="submit" class="btn btn-success form-control">submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#jalaliDatePicker").datepicker({
                dateFormat: "yy/mm/dd"
            });
            $("#jalaliDatePickerBtn").click(function (event) {
                event.preventDefault();
                $("#jalaliDatePicker").focus();
            });
            $("#jalaliDatePicker1").datepicker({
                dateFormat: "yy/mm/dd"
            });
            $("#jalaliDatePickerBtn1").click(function (event) {
                event.preventDefault();
                $("#jalaliDatePicker").focus();
            });
        });
    </script>
    @endsection


