@extends('admin.layout')

@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Announcement
            </div>
            <div class="panel-body">
                @include('admin.announcement.partials.form',['route'=>['admin.announcement.update',$announcement->id],'buttonName'=>'save'])
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#jalaliDatePicker1").datepicker({
                dateFormat: "yy/mm/dd"
            });
            $("#jalaliDatePickerBtn1").click(function (event) {
                event.preventDefault();
                $("#jalaliDatePicker").focus();
            });
        });
    </script>
@endsection


