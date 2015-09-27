@extends('profile.layout')

@section('content')

    <div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills violet skill-step nav-justified thumbnail setup-panel">
                <li @if($step == 1)class="active"@endif><a >
                        <h4 class="list-group-item-heading">گام اول</h4>
                        <p class="list-group-item-text">ثبت اطلاعات کلی مهارت</p>
                    </a></li>
                <li @if($step == 2)class="active"@endif><a >
                        <h4 class="list-group-item-heading">گام دوم</h4>
                        <p class="list-group-item-text">مدارک، سوابق و نمونه کارها</p>
                    </a></li>
                <li @if($step == 3)class="active"@endif><a >
                        <h4 class="list-group-item-heading">گام سوم</h4>
                        <p class="list-group-item-text">زمان، مکان و هزینه ارائه مهارت</p>
                    </a></li>
            </ul>
        </div>
    </div>

    @if($new_skill == 1)
        @include('profile.partials.skillInfo', ['has_edit'=>0])
    @elseif($edit_skill == 1 and $new_skill == 0)
        @if($step == 1)
            @include('profile.partials.skillInfo', ['has_edit'=>1])
        @elseif($step == 2)
            @include('profile.partials.skillExperiences')
            @include('profile.partials.skillDegrees')
            @include('profile.partials.skillHonor')
            @role('user')
            @include('profile.partials.skillHistory')
            @endrole
            @include('profile.partials.skillPaper')

            <a class="btn btn-success" href="{{ route('profile.skill.edit.step3', ['skill'=>$skill->id]) }}">ادامه به مرحله بعد</a> &ensp;
            <a class="btn btn-default" href="{{ route('profile.skill.edit.step1', ['skill'=>$skill->id]) }}">  بازگشت به مرحله قبل </a>

            <br><br>
        @elseif($step == 3)
            @include('profile.partials.skillSchedule')
            @include('profile.partials.skillAmount')
            @include('profile.partials.skillArea')
            @role('legal')
            @include('profile.partials.skillGalleries')
            @endrole

            <a class="btn btn-success" href="{{ route('profile.me', ['skill'=>$skill->id]) }}">پایان ثبت مهارت</a> &ensp;
            <a class="btn btn-default" href="{{ route('profile.skill.edit.step2', ['skill'=>$skill->id]) }}">  بازگشت به مرحله قبل </a>

            <br><br>
        @endif
    @endif



@endsection

@section('side')

@endsection

@section('script')
    <script src="{{ asset('js/skill.js') }}"></script>
@endsection