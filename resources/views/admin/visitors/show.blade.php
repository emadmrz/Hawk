@extends('admin.layout')
@section('content')
    <div class="col-lg-12">

        <div id="myfirstchart" style="height: 250px;"></div>

    </div>

@endsection
@section('script')
    {{--Create By Dara on 13/9/2015
    handling the morris diagram--}}
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                @foreach($chartDatas as $data)
                {day: '{{$data['date']}}', value: {{$data['count']}} },
                    @endforeach



            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'day',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    </script>

@endsection