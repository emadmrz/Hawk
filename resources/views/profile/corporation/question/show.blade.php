@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                پرسشنامه همکاری
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="50%" class="text-right">سوال</th>
                        <th width="10%" class="text-right">جواب</th>
                        <th width="10%" class="text-right">پاسخ دهنده</th>
                        <th width="15%" class="text-right">تاریخ پاسخ</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $key=>$answer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$answer->question->content}}</td>
                            <td>{{ $answer->answer_name }}</td>
                            <td>{{$answer->corporation->sender->username}}</td>
                            <td>{{$answer->shamsi_created_at}}</td>
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