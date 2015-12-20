@extends('profile.layout')

@section('side')
    @include('store.showcase.situations')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                {{ $situation }}
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="25%" class="text-right">درخواست دهنده</th>
                        <th width="25%" class="text-right">پروفایل</th>
                        <th width="20%" class="text-right">تاریخ</th>
                        <th width="15%" class="text-right">وضعیت</th>
                        <th width="15%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $key=>$request)
                        <tr>
                            @if($request->user_id == $user->id)
                                <td>شما</td>
                            @else
                                <td><a href="#" target="_blank" >{{ $request->user->username }}</a></td>
                            @endif

                            @if($request->profile_id == $user->id)
                                <td>شما</td>
                            @else
                                <td><a href="#" target="_blank" >{{ $request->profile->username }}</a></td>
                            @endif

                            <td>{{ $request->shamsi_created_at }}</td>
                            <td>
                                @if($request->situation == 1)
                                    <span  class="label label-success">فعال</span>
                                @elseif($request->situation == 0  or $request->profile->showcases()->active()->count() == 4)
                                    <span class="label label-warning">در لیست رزرو</span>
                                @elseif($request->situation == 2)
                                    <span class="label label-warning">منتظر پرداخت هزینه</span>
                                @endif
                            </td>
                            <td>
                                @if($request->situation == 1)
                                    <a href="{{ route('home.profile', $request->profile_id) }}" class="btn btn-success btn-xs">مشاهده تبلیغ</a>
                                @elseif($request->situation == 0 and $user->showcases()->active()->count() < 4)
                                    @if($request->profile_id == $user->id)
                                        <a href="{{ route('profile.management.addon.showcase.approve', $request->id) }}" class="btn btn-info btn-xs">تایید درخواست</a>
                                    @endif
                                @elseif($request->situation == 2)
                                    @if($request->profile_id == $user->id)
                                        <a href="{{ route('profile.management.addon.showcase.approve', $request->id) }}" class="btn btn-danger btn-xs">لغو درخواست</a>
                                    @elseif($request->profile->showcases()->active()->count() < 4)
                                        <a href="{{ route('store.showcase', $request->id) }}" class="btn btn-info btn-xs">پرداخت هزینه</a>
                                    @endif
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