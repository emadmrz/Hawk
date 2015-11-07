@extends('admin.layout')

@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Balance
            </div>

            <div class="panel-body">

                {!! Form::open(['route' => ['admin.credit.update',$user->id ]]) !!}
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-8">
                            {!! Form::label('amount','amount :') !!}
                            {!! Form::input('number','amount',null,['class'=>'form-control','min'=>0]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            {!! Form::label('operation','operation :') !!}
                            {!! Form::select('operation',[0=>'removal',1=>'settle'],1,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            {!! Form::label('description','description :') !!}
                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-success form-control">submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection


