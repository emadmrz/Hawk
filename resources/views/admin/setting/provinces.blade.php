@extends('admin.layout')

@section('content')
    <div class="col-lg-7">

        <div class="panel panel-default">
            <div class="panel-heading">
                Add New Province
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>'admin.setting.province.create', 'method'=>'post', 'class'=>'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name : ') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Create New', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Provinces List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($provinces as $province)
                            <tr>
                                <td width="10%">{{ $province->id }}</td>
                                <td width="50%">{{ $province->name }}</td>
                                <td width="40%">
                                    <a href="{{ route('admin.setting.cities', ['province'=> $province->id ]) }}" class="btn btn-primary btn-sm">cities</a>
                                    <a href="{{ route('admin.setting.province.edit', ['province'=> $province->id  ]) }}" class="btn btn-info btn-sm">edit</a>
                                    <a data-delete-confirm href="{{ route('admin.setting.province.delete', ['province'=> $province->id  ]) }}" class="btn btn-danger btn-sm">del</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>

    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Province
            </div>
            <div class="panel-body">
                @if(!$hasEdit)
                    Noting to edit
                @else
                    {!! Form::model($province_edit, ['route'=>['admin.setting.province.update', $province_edit->id], 'method'=>'put', 'class'=>'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name : ') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.setting.provinces') }}" class="btn btn-default" >back</a>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

@endsection
