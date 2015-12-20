@extends('profile.layout')
@section('content')
    <div class="top-list-search">
        <div class="row">

            {!! Form::model($bind,['method'=>'GET','route'=>'profile.dashboard.index','id'=>'chart_form']) !!}

            <div class="col-sm-4 pull-right">
                {!! Form::select('skill_id',$skillSelect,null,['class'=>'form-control input-sm','id'=>'chart_select']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div style="float: right; height:200px;" id="donut-problem"></div>
        </div>
        <div class="col-sm-6">
            <div style="float: right; height: 200px;" id="donut-corporation"></div>
        </div>
        <div class="col-sm-6">
            <div style="float: right; height: 300px;" id="line-rate"></div>
        </div>
        @if(!empty($corporationQuestion))
        <div class="col-sm-8">
            <div style="float: right; height: 300px;" id="bar-question"></div>
        </div>
        @endif
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/admin/raphael-min.js') }}"></script>
    <script src="{{ asset('js/admin/morris.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            /*problem answer chart*/
            Morris.Donut({
                element: 'donut-problem',
                data: [

                    { label: "پاسخ های درست", value: '{{$trueAnswer}}' },
                    { label: "پاسخ های نادرست", value: '{{$falseAnswer}}' }

                ]
            });

            /*corporation chart*/
            Morris.Donut({
                element: 'donut-corporation',
                data: [

                    { label: "مشتری", value: '{{$numCorporation}}' },
                    { label: "غیر مشتری", value: '{{$numNoCorporation}}' }

                ]
            });

            /*rate chart*/
            Morris.Line({
                element: 'line-rate',
                data: [

                    @foreach($rateResults as $rate)
                    { y: '{{$rate->created_at}}', a: '{{$rate->rate}}' },
                        @endforeach


                ],
                xkey: 'y',
                ykeys: 'a',
                labels: ['رتبه'],
                goals: [1.0, 5.0],
                ymax:5,
                ymin:1,
                eventLineColors:'f0f0f0'
            });

            /*question corporation chart*/
            @if(!empty($corporationQuestion))
            Morris.Bar({
                element: 'bar-question',
                data: [
                    { y: 'کیفیت', a: '{{$corporationQuestion[1]}}' },
                    { y: 'قیمت', a: '{{$corporationQuestion[2]}}' },
                    { y: 'پایبندی به زمان', a: '{{$corporationQuestion[3]}}' },
                    { y: 'اخلاق', a: '{{$corporationQuestion[4]}}' }

                ],
                xkey: 'y',
                ymax:5,
                        ymin:1,
                ykeys: ['a'],
                labels: ['همکاری']
            });
            @endif

            $('#chart_select').change(function(){
               $('form#chart_form').submit();
            });
        });

    </script>
@endsection