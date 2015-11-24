@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت پرسشنامه ها
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">عنوان</th>
                        <th width="15%" class="text-right">تعداد پرسشنامه</th>
                        <th width="15%" class="text-right">تاریخ</th>
                        <th width="10%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questionnaires as $key=>$questionnaire)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td >{{ $questionnaire->title }}</td>
                            <td >{{ $questionnaire->count }}</td>
                            <td >{{ $questionnaire->shamsi_created_at }}</td>
                            <td>
                                @if($questionnaire->status == 1)
                                    <span class="label label-info">پرداخت موفق و منتظر انتشار</span>
                                @elseif($questionnaire->status == 2)
                                    <span class="label label-success">منتشر شده برای کاربران</span>
                                @elseif($questionnaire->status == 0)
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @endif
                            </td>
                            <td>
                                @if($questionnaire->status == 1)
                                    <a href="{{ route('profile.management.addon.questionnaire.edit',['questionnaire'=>$questionnaire->id]) }}" class="btn btn-info btn-xs">ویرایش</a>
                                @elseif($questionnaire->status == 2)
                                    <a href="{{ route('home.questionnaire.preview',['profile'=>$questionnaire->user_id, 'questionnaire'=>$questionnaire->id]) }}" class="btn btn-success btn-xs">مشاهده</a>
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