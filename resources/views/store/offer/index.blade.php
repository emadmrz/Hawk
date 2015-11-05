@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
    @include('store.offer.partials.offerManagementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت افزونه پیشنهاد ویژه
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>

                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">تاریخ اتمام</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $key=>$offer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if($offer->status)
                                    <span class="label label-success">پرداخت موفق</span>
                                @else
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @endif
                            </td>
                            <td>{{$offer->shamsi_expired_at}}</td>
                            <td><a href="{{route('profile.management.addon.offer.edit',[$offer->id])}}">
                                    <i class="fa fa-pencil"> ویرایش</i>
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