@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت درخواست های همکاری
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>

                        <th width="5%" class="text-right">از طرف</th>
                        <th width="5%" class="text-right">مهارت</th>
                        <th width="5%" class="text-right">تاریخ درخواست</th>
                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($corporations as $key=>$corporation)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{route('home.profile',[$corporation->sender_id])}}">{{$corporation->sender->username}}</a></td>
                            <td>{{$corporation->skill->title}}</td>
                            <td>{{$corporation->shamsi_created_at}}</td>
                            <td>
                                @if($corporation->status==2)
                                    <span class="label label-info">بررسی نشده</span>
                                @elseif($corporation->status==1)
                                    <span class="label label-success">تایید شده</span>
                                @elseif($corporation->status==0)
                                    <span class="label label-danger">لغو شده</span>
                                @endif
                            </td>

                            <td>
                                @if($corporation->question_completed==1)
                                    <a href="{{route('profile.corporation.question.show',[$corporation->id])}}">مشاهده پرسشنامه</a>
                                @elseif($corporation->question_completed==0)
                                    <a href="{{route('profile.corporation.index',[$corporation->id])}}">بررسی</a>
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
                مدیریت درخواست های همکاری خودم
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>

                        <th width="5%" class="text-right">به</th>
                        <th width="5%" class="text-right">مهارت</th>
                        <th width="5%" class="text-right">تاریخ درخواست</th>
                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myCorporations as $key=>$corporation)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{route('home.profile',[$corporation->receiver_id])}}">{{$corporation->receiver->username}}</a></td>
                            <td>{{$corporation->skill->title}}</td>
                            <td>{{$corporation->shamsi_created_at}}</td>
                            <td>
                                @if($corporation->status==2)
                                    <span class="label label-info">بررسی نشده</span>
                                @elseif($corporation->status==1)
                                    <span class="label label-success">تایید شده</span>
                                @elseif($corporation->status==0)
                                    <span class="label label-danger">لغو شده</span>
                                @endif
                            </td>

                            <td>
                                @if($corporation->status==1)
                                    @if($corporation->question_completed==0)
                                        <a href="{{route('profile.corporation.question.index',[$corporation->id])}}">تکمیل پرسشنامه</a>
                                    @elseif($corporation->question_completed==1)
                                        <a href="{{route('profile.corporation.question.show',[$corporation->id])}}">مشاهده پرسشنامه</a>
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
@section('script')
    <script>

    </script>
@endsection