@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت افزونه افزایش رتبه پروفایل
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="5%" class="text-right">نوع</th>

                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">تاریخ اتمام</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($relaters as $key=>$relater)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if($relater->type==1)
                                    طلایی
                                @elseif($relater->type==2)
                                    نقره ای
                                @elseif($relater->type==3)
                                    برنزی
                                @endif
                            </td>
                            <td>
                                @if($relater->status)
                                    <span class="label label-success">پرداخت موفق</span>
                                @else
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @endif
                            </td>
                            <td>{{$relater->shamsi_expired_at}}</td>
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