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
                        <th class="text-right">نام گروه</th>
                        <th class="text-right">مدیر گروه</th>
                        <th class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $key=>$group)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$group->name}}</td>
                            <td>{{$group->user->first_name}} {{$group->user->last_name}}</td>
                            @if($group->user_id==$user->id)
                                <td>
                                    <a href="{{route('profile.group.edit',[$group->id])}}">ویرایش</a>
                                    <a class="text-center" href="{{route('profile.group.delete',[$group->id])}}">حذف</a>
                                </td>

                            @endif
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