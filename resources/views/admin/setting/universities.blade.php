@extends('admin.layout')

@section('content')
    <div class="col-lg-7">

        <div class="panel panel-default">
            <div class="panel-heading">
                Add New University
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['admin.setting.university.create'], 'method'=>'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name : ') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', 'Logo Full Address : ') !!}
                    {!! Form::text('logo', null, ['class'=>'form-control']) !!}
                </div>
                {!! Form::submit('Create New', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Cities List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>logo</th>
                            <th>actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($universities as $university)
                            <tr>
                                <td width="10%">{{ $university->id }}</td>
                                <td width="35%">{{ $university->name }}</td>
                                <td width="35%"><a href="{{ $university->logo }}">View Logo</a></td>
                                <td width="20%">
                                    <a href="{{ route('admin.setting.university.edit', $university->id) }}" class="btn btn-info btn-sm">edit</a>
                                    <a data-delete-confirm href="{{ route('admin.setting.university.delete', $university->id) }}" class="btn btn-danger btn-sm">del</a>
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
                Edit University
            </div>
            <div class="panel-body">
                @if(!$hasEdit)
                    Noting to edit
                @else
                    {!! Form::model($university_edit, ['route'=>['admin.setting.university.update', $university_edit->id], 'method'=>'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name : ') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('logo', 'Logo Full Address : ') !!}
                        {!! Form::text('logo', null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.setting.universities') }}" class="btn btn-default" >back</a>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

@endsection
