@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Infos
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Phone1</th>
                            <th>Phone2</th>
                            <th>Cellphone</th>
                            <th>Fax</th>
                            <th>Address</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Visit</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($infos as $key=>$info)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$info->phone1}}</td>
                                <td>{{$info->phone2}}</td>
                                <td>{{$info->cell_phone}}</td>
                                <td>{{$info->fax}}</td>
                                <td>{{$info->address}}</td>
                                <td>{{$info->province}}</td>
                                <td>{{$info->city}}</td>
                                <td>{{$info->num_visit}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$user->id])}}">Preview</a>
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
    @if($user->isUser())
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Educations
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>School/University</th>
                            <th>Degree</th>
                            <th>Field</th>
                            <th>Entrance. Year</th>
                            <th>Graduate. Year</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($educations as $key=>$education)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$education->university->name}}</td>
                                <td>
                                    @if($education->degree==1)
                                        متوسطه
                                    @elseif($education->degree==2)
                                        دیپلم
                                    @elseif($education->degree==3)
                                        کاردانی
                                    @elseif($education->degree==4)
                                        کارشناسی
                                    @elseif($education->degree==5)
                                        کارشناسی ارشد
                                    @elseif($education->degree==6)
                                        دکتری
                                    @endif
                                </td>
                                <td>{{$education->field}}</td>
                                <td>{{$education->entrance_year}}</td>
                                <td>{{$education->graduate_year}}</td>
                                <td>
                                    @if($education->status==0)
                                        Studying
                                    @elseif($education->status==1)
                                        Graduated
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$user->id])}}">Preview</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$educations->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>
    @endif
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Bio
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$bio->text}}</td>
                                <td>
                                    @if($bio->files()->exists())
                                        <a class="btn btn-info" href="{{asset('img/files')}}/{{$bio->files()->first()->name}}">Attachment</a>
                                    @endif
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection


