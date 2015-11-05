@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection
@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                کوپن های خریداری شده
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">عنوان</th>
                        <th class="text-right">توضیحات</th>
                        <th class="text-right">انقضا</th>
                        <th class="text-right">وضعیت</th>
                        <th class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $key=>$service)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$service->title}}</td>
                            <td>{{$service->description}}</td>
                            <td>{{$service->shamsi_expired_at}}</td>
                            <td>
                                @if($service->status==1)
                                    <span class="label label-success">فعال</span>
                                @elseif($service->status==0)
                                    <span class="label label-danger">غیر فعال</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('profile.management.addon.offer.service.edit',[$service->id])}}">ویرایش</a>
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