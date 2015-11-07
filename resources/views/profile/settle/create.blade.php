@extends('profile.layout')

@section('side')
    @include('partials.settleManagement')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                درخواست تسویه
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.settle.store']]) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('bank','انتخاب بانک :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('bank',[0=>'ملت',1=>'پاسارگاد'],null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('way','نحوه تسویه :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('way',[0=>'کارت به کارت',1=>'ساتنا',2=>'پایا'],null,['class'=>'form-control','id'=>'payment-method']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('account_number','شماره کارت :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('account_number',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div style="display: none;" id="sheba" class="form-group panel-form">
                        {!! Form::label('account_sheba','شماره شبا :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('account_sheba',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('amount','مقدار قابل تسویه :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::input('number','amount',$cash,['class'=>'form-control','disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>ثبت درخواست</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#payment-method').change(function(){
               if(this.value==1 || this.value==2){
                    $("#sheba").show();
                }
                if(this.value==0){
                    $("#sheba").hide();
                }
            });
        });
    </script>
    @endsection