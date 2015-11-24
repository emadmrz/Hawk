@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection
@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                گروه های من
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th width="30%" class="text-right">نام گروه</th>
                        <th width="20%" class="text-right">مدیر گروه</th>
                        <th width="20%" class="text-right">تاریخ ایجاد گروه</th>
                        <th width="30%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $key=>$group)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$group->name}}</td>
                            <td>{{$group->user->username}}</td>
                            <td>{{$group->shamsi_created_at}}</td>
                            <td>
                                <a class="btn btn-success btn-xs" href="{{route('group.index',[$group->id])}}"><i class="fa fa-eye"></i> مشاهده </a>
                                @if($group->user_id==$user->id)
                                    <a class="btn btn-info btn-xs" href="{{route('profile.group.edit',[$group->id])}}"><i class="fa fa-pencil"></i> ویرایش </a>
                                    <a class="btn btn-danger btn-xs" href="{{route('profile.group.delete',[$group->id])}}"><i class="fa fa-trash-o"></i> حذف </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection