@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                نظرات من
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">موضوع</th>
                        <th class="text-right">توضیحات</th>
                        <th class="text-right">لینک</th>
                        <th class="text-right">تاریخ</th>
                        <th class="text-right">وضعیت</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($feedbacks as $key=>$feedback)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$feedback->title}}</td>
                            <td>{{$feedback->body}}</td>
                            <td>{{$feedback->link}}</td>
                            <td>{{$feedback->shamsi_created_at}}</td>
                            @if($feedback->status==0)
                                <td>در حال بررسی</td>
                            @elseif($feedback->status==1)
                                <td>بررسی شد</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $feedbacks->render() !!}</div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection