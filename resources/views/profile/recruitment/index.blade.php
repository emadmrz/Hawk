@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="top-list-search">
        <div class="row">
            {!! Form::open(['route'=>'profile.recruitment.search']) !!}
            <div class="col-sm-3 pull-right">
                {!! Form::select('first_category',$main_categories,null,['class'=>'form-control input-sm','id'=>'category_id']) !!}
            </div>
            <div class="col-sm-3 pull-right">
                {!! Form::select('second_category',[],null,['class'=>'form-control input-sm','id'=>'sub_category_id']) !!}
            </div>
            <button type="submit" class="btn btn-violet btn-sm">جستجوی استخدام </button>
            <a href="{{route('profile.recruitment')}}" class="btn btn-success pull-left btn-sm">آگهی های در زمینه فعالیت</a>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                آگهی های استخدام
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="5%" class="text-right">آگهی دهنده</th>
                        <th width="5%" class="text-right">عنوان شغل</th>
                        <th width="5%" class="text-right">تاریخ اتمام</th>
                        <th width="5%" class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($relatedRecruitments as $key=>$relatedRecruitment)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{route('home.profile',$relatedRecruitment->user->id)}}">{{$relatedRecruitment->user->username}}</a></td>
                            <td>{{$relatedRecruitment->job_title}}</td>
                            <td>{{$relatedRecruitment->shamsi_expired_at}}</td>
                            <td>

                                <?php
                                    $existence=$relatedRecruitment->requesters()->where('user_id',$user->id)->exists();
                                ?>

                                @if($relatedRecruitment->expired_at<=Carbon\Carbon::now())
                                    <a class="btn btn-danger" href="#">منقضی شده</a>
                                    @elseif(!$existence)
                                    <a class="btn btn-info" href="{{route('home.recruitment.preview',[$relatedRecruitment->user->id,$relatedRecruitment->id])}}">بررسی</a>
                                @endif
                                @if($existence)
                                        <a class="btn btn-primary" href="{{route('profile.recruitment.requester.preview',[$relatedRecruitment->id,$relatedRecruitment->requesters()->where('user_id',$user->id)->where('recruitment_id',$relatedRecruitment->id)->first()->id])}}">مشاهده</a>
                                @endif
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