@extends('top.layout')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

    <div class="top-list-search">
        <div class="row">

            {!! Form::open(['method'=>'GET']) !!}

                <div class="col-sm-1 pull-right">
                    {!! Form::select('type',[1=>'کاربران',2=>'کالا ها'],null,['class'=>'form-control input-sm']) !!}
                </div>

                <div class="col-sm-2 pull-right">
                    {!! Form::select('sort',[1=>'پر ستاره ترین ها',2=>'پر بازدید ترین ها',3=>'محبوب ترین ها',4=>'پر مشتری ترین ها'],null,['class'=>'form-control input-sm']) !!}
                </div>

                <div class="col-sm-2 pull-right">
                    {!! Form::select('category',$categorySelect,null,['class'=>'form-control input-sm']) !!}
                </div>


                <button type="submit" class="btn btn-violet btn-sm">جستجوی برترین ها</button>

                <button class="btn btn-success pull-left btn-sm">چگونه جزء برترین ها شوم ؟</button>

            {!! Form::close() !!}

        </div>
    </div>
@if(!empty($results))
    @foreach($results as $key=>$result)
        <div class="col-sm-12">
            <div class="part-title">
                <h3> <a href="{{route('top',['show'=>$key])}}" class="btn btn-violet btn-sm pull-left">لیست کامل</a>{{preg_replace('/\d/', '', $key )}}</h3>
            </div>
        </div>
        @foreach($result as $user)
            <div class="search-result">
                <div class="col-sm-3">
                    <div class="search-card">
                        <div class="avatar">
                            <img src="{{ asset('img/persons') }}/{{$user->avatar}}">
                        </div>
                        <div class="name">
                            {{$user->username}}
                        </div>
                        <div class="rate">
                            <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                        </div>
                        <div class="about-me">
                            {{$user->description}}
                        </div>
                        <div class="action text-center">
                            <a href="{{route('home.profile',$user->id)}}" type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endif
@endsection

