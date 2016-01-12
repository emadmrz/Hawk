<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            {{$recruitment->job_title}}
        </div>
        <div class="panel-body">
            {!! Form::model($recruitment) !!}
            <input type="hidden" name="cropper_json" id="cropper_json" value="">
            <div class="clearfix form-horizontal">
                <div class="form-group panel-form">
                    {!! Form::label('group_title','عنوان مجموعه :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('group_title',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_title','عنوان شغل :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_title',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_description','شرح شغل :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_description',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_responsibility','مسئولیت و وظایف :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_responsibility',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_condition','شرایط احراز :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_condition',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_office','محل کار :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_office',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>

                <div class="form-group panel-form">
                    {!! Form::label('job_style','شرایط کار :',['class'=>'control-label pull-right col-sm-2']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('job_style',null,['class'=>'form-control','disabled']) !!}

                    </div>
                </div>





                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        @if(!$recruitment->image)
                            <div id="crop_image_preview"><img src="{{ asset('img/cover/offer_preview.jpg') }}"></div>
                        @else
                            <div id="crop_image_preview"><img src="{{ asset('img/files') }}/{{$recruitment->image}}"></div>
                        @endif
                    </div>
                </div>



            </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer text-footer">
            <i class="fa fa-clock-o fa-lg" ></i>
        </div>
    </div>
</div>

<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            پرسشنامه
        </div>
        <div class="panel-body">
            <div class="clearfix form-horizontal">
                @foreach($questions as $question)
                    <div class="form-group panel-form">
                        {!! Form::label("question[$question->id]",$question->content,['class'=>'control-label pull-right col-sm-7']) !!}
                        <div class="col-sm-5">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="panel-footer text-footer">
            <i class="fa fa-clock-o fa-lg" ></i>
        </div>
    </div>
</div>
