@extends('admin.layout')

@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Confirm User Request
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>From</th>
                        <th>Bank</th>
                        <th>Transfer Method</th>
                        <th>Account Number</th>
                        <th>Sheba Number</th>
                        <th>Create Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $settle->user->username }}</td>
                            <td>{{ $settle->bank }}</td>
                            <td>{{$settle->way}}</td>
                            <td>{{$settle->account_number}}</td>
                            <td>{{$settle->account_sheba}}</td>
                            <td>{{$settle->shamsi_created_at}}</td>
                        </tr>
                    </tbody>
                </table>

                {!! Form::open(['route' => ['admin.settle.update',$settle->id ]]) !!}
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-8">
                            {!! Form::label('amount','amount :') !!}
                            {!! Form::input('number','amount',$settle->amount,['class'=>'form-control','disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            {!! Form::label('operation','operation :') !!}
                            {!! Form::select('operation',[0=>'Pay',1=>'Deny'],0,['class'=>'form-control']) !!}
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


