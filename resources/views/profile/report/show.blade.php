@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                گزارشات من
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
                    @foreach($reports as $key=>$report)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$report->title}}</td>
                            <td>{{$report->description}}</td>
                            <td><a href="{{$report->link}}">مشاهده</a></td>
                            <td>{{$report->shamsi_created_at}}</td>
                            @if($report->status==0)
                                <td>در حال بررسی</td>
                            @elseif($report->status==1)
                                <td>بررسی شد</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $reports->render() !!}</div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection