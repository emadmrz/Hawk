@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت افزونه آگهی استخدام
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>

                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">عنوان شغل</th>
                        <th width="5%" class="text-right">تاریخ اتمام</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recruitments as $key=>$recruitment)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if($recruitment->status==1)
                                    <span class="label label-success">پرداخت موفق و آماده انتشار</span>
                                @elseif($recruitment->status==0)
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @elseif($recruitment->status==2 && $recruitment->active==0)
                                    <span class="label label-danger">در انتظار تایید مدیریت</span>
                                @elseif($recruitment->status==2 && $recruitment->active==1)
                                    <span class="label label-danger">تایید و منتشر شده</span>
                                @endif
                            </td>
                            <td>{{$recruitment->job_title}}</td>
                            <td>{{$recruitment->shamsi_expired_at}}</td>
                            <td>
                                @if($recruitment->status==1)
                                    <a href="{{route('profile.management.addon.recruitment.edit',[$recruitment->id])}}">
                                        <i class="fa fa-pencil"> ویرایش</i>
                                    </a>
                                @elseif($recruitment->status==2)
                                    <a href="{{route('profile.management.addon.recruitment.preview',[$recruitment->id])}}">
                                        <i class="fa fa-pencil"> نمایش</i>
                                    </a>
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

    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیرت متقاضیان
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="5%" class="text-right">نام</th>
                        <th width="5%" class="text-right">عنوان شغل</th>
                        <th width="5%" class="text-right">تاریخ ارسال</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requesters as $key=>$requester)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $requester->user->username }}</td>
                            <td>{{$requester->recruitment->job_title}}</td>
                            <td>{{$requester->shamsi_created_at}}</td>
                            <td>
                                <a href="{{route('profile.management.addon.recruitment.requester.preview',[$recruitment->id,$requester->id])}}">
                                    <i class="fa fa-pencil"> نمایش</i>
                                </a>
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
    <script>

    </script>
@endsection