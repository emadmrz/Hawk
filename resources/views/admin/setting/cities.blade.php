@extends('admin.layout')

@section('content')
    <div class="col-lg-7">

        <div class="panel panel-default">
            <div class="panel-heading">
                Add New City
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['admin.setting.city.create', 'province'=>$province->id], 'method'=>'post', 'class'=>'form-inline']) !!}
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
                            <th>actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td width="10%">{{ $city->id }}</td>
                                <td width="50%">{{ $city->name }}</td>
                                <td width="40%">
                                    <a href="{{ route('admin.setting.city.edit', ['province'=>$province->id, 'city'=> $city->id ]) }}" class="btn btn-info btn-sm">edit</a>
                                    <a data-delete-confirm href="{{ route('admin.setting.city.delete', ['province'=>$province->id, 'city'=> $city->id ]) }}" class="btn btn-danger btn-sm">del</a>
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
                Edit Cities
            </div>
            <div class="panel-body">
                @if(!$hasEdit)
                    Noting to edit
                @else
                    {!! Form::model($city_edit, ['route'=>['admin.setting.city.update', 'province'=>$province->id, 'city'=>$city_edit->id ], 'method'=>'put', 'class'=>'form-inline']) !!}
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
