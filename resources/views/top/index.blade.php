@extends('top.layout')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

    <div class="top-list-search">
        <div class="row">

            {!! Form::model($bind,['method'=>'GET','route'=>'top.result']) !!}

                <div class="col-sm-1 pull-right">
                    {!! Form::select('type',[1=>'کاربران',2=>'کالا ها'],null,['id'=>'top_type_id','class'=>'form-control input-sm']) !!}
                </div>

                <div class="col-sm-2 pull-right">
                    {!! Form::select('sort',$sortSelect,null,['id'=>'top_sort_id','class'=>'form-control input-sm']) !!}
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
                @if($type=='user')
                    <h3> <a href="{{route('top.result',['type'=>1,'sort'=>1,'category'=>intval($key)])}}" class="btn btn-violet btn-sm pull-left">لیست کامل</a>{{preg_replace('/\d/', '', $key )}}</h3>
                @endif
                    @if($type=='product')
                        @if(isset($bind->sort))
                            <?php $sort=$bind->sort; ?>
                        @else
                            <?php $sort=2; ?>
                        @endif
                        <h3> <a href="{{route('top.result',['type'=>2,'sort'=>$sort,'category'=>intval($key)])}}" class="btn btn-violet btn-sm pull-left">لیست کامل</a>{{preg_replace('/\d/', '', $key )}}</h3>
                    @endif
            </div>
        </div>
        @if($type=='user')
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
        @elseif($type=='product')
            @foreach($result as $product)
                <div class="search-result">
                    <div class="col-sm-3">
                        <div class="search-card">
                            <div class="avatar">
                                @if(count($product->files))
                                    <img src="{{asset('img/files/shop/'.$product->files->first()->name)}}">
                                @else
                                    <img src="aaa">
                                @endif
                            </div>
                            <div class="name">
                                {{$product->name}}
                            </div>
                            <div class="rate">
                                <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                            <div class="about-me">
                                {{$product->description}}
                            </div>
                            <div class="action text-center">
                                <a href="{{route('home.shop.product',[$product->shop->id,$product->id])}}" type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i>مشاهده </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
@endif
@endsection

