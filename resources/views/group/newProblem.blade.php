@extends('group.layout')
@section('side')
    @include('group.partials.addProblem')
    {{--@include('group.partials.sideProblem')--}}
    @include('group.partials.latestPosts')
    @include('group.partials.latestProblems')
    @include('group.partials.allMembers')
@endsection
@section('content')
    @include('group.partials.problem')
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $("#problem_submit_btn").click(function(){
                $("#problem_form").submit();
            })

        });
    </script>
@endsection