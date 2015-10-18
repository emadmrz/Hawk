@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت نظرسنجی ها
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">عنوان</th>
                        <th width="50%" class="text-right">پرسش</th>
                        <th width="15%" class="text-right">ارسال برای</th>
                        <th width="10%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($polls as $key=>$poll)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td style="font-size: 12px">{{ $poll->title }}</td>
                            <td style="font-size: 12px">{{ $poll->question }}</td>
                            <td style="font-size: 12px">
                                @if($poll->scope == 1)
                                    دوستان
                                @elseif($poll->scope == 2)
                                    کاربران سطح سوم
                                @elseif($poll->scope == 3)
                                    کاربران سطح دوم
                                @endif

                            </td>
                            <td>
                                @if($poll->status == 1)
                                    <span class="label label-info">پرداخت موفق و منتظر انتشار</span>
                                @elseif($poll->status == 2)
                                    <span class="label label-success">منتشر شده برای کاربران</span>
                                @elseif($poll->status == 0)
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @endif
                            </td>
                            <td>
                                @if($poll->status == 1)
                                    <a href="{{ route('profile.management.addon.poll.edit',['poll'=>$poll->id]) }}" class="btn btn-info btn-xs">ویرایش</a>
                                @elseif($poll->status == 2)
                                    <a href="{{ route('home.poll.preview',['profile'=>$poll->user_id, 'poll'=>$poll->id]) }}" class="btn btn-success btn-xs">مشاهده</a>
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