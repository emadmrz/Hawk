@extends('profile.layout')
@section('side')
    @include('store.recruitment.partials.recruitmentManagementMenu')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                انتخاب پرسش ها
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.recruitment.question.submit',$recruitment->id],'files'=>true]) !!}
                <div class="clearfix form-horizontal">
                    @foreach($defaultQuestions as $question)
                        <div class="form-group panel-form">
                            <label class="control-label pull-right col-sm-7">{{$question->content}}</label>
                            <div class="col-sm-5 pull-right">
                                {!! Form::checkbox("question[$question->id]",$question->id,$question->selected,['class'=>'form-control pull-right']) !!}

                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>ثبت تغییرات</button>
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
                افزودن پرسش
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.recruitment.question.add',$recruitment->id],'files'=>true]) !!}
                <input type="hidden" name="cropper_json" id="cropper_json" value="">
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        <div class="col-sm-7">
                            {!! Form::text('question',null,['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>افزودن</button>
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


    </script>

@endsection