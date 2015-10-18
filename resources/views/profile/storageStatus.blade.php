@extends('profile.layout')

@section('side')
    @include('profile.partials.settingMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                وضعیت حجم حساب کاربری
            </div>
            <div class="panel-body">
                <div class="col-sm-4 pull-right en-number">
                    <p>حجم پروفایل : {{ $usage->capacity }} MB</p>
                    <p> حجم مصرفی : {{ $usage->usage }} MB</p>
                    <p> حجم باقی مانده : {{ ($usage->capacity - $usage->usage) }} MB</p>
                    <a href="{{ route('store.storage') }}" class="btn btn-success btn-sm" title="افزایش حجم پروفایل">افزایش حجم پروفایل</a>
                </div>
                <div class="col-sm-8">
                    <h3 class="storage-usage" >نمودار فضای مصرفی از حساب کاربری</h3>
                    <div id="storage_pie" style="width: 300px; height: 250px">

                    </div>
                </div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script language="javascript" type="text/javascript" src="{{ asset('js/flot/jquery.flot.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/flot/jquery.flot.pie.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script>
        var placeholder = $("#storage_pie");
        var data = [];
        data[0] = {
            label: ' فضای پر شده ',
            data: {{ ($usage->usage*100)/($usage->capacity)  }},
            color: '#8456A7'
        };
        data[1] = {
            label: ' فضای خالی ' ,
            data: {{ (($usage->capacity-$usage->usage)*100)/($usage->capacity)  }},
            color: '#5cb85c'
        };

        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0% %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });
    </script>
@endsection