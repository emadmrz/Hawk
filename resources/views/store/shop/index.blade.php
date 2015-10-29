@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت فروشگاه
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">نام فروشگاه</th>
                        <th width="20%" class="text-right">تعداد بازدید</th>
                        <th width="20%" class="text-right">تاریخ</th>
                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $shop->title }}</td>
                            <td>{{ $shop->num_visit }}</td>
                            <td>{{ $shop->shamsi_created_at }}</td>
                            <td>
                                @if($shop->status)
                                    <span class="label label-success">پرداخت موفق وایجاد فروشگاه</span>
                                @else
                                    <span class="label label-danger">پرداخت ناموفق و عدم ایجاد</span>
                                @endif
                            </td>
                            <td><a href="{{ route('profile.management.addon.shop.edit', $shop->id) }}"  class="btn btn-info btn-xs">ویرایش</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection