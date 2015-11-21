@if($results->count()>0)
@foreach($results as $result)
    @if($section=='users')
<li>
    <div class="media">
        <div class="media-right">
            <a href="{{route('home.profile',$result->id)}}"><img class="media-object img-circle" src="{{ asset('img/persons' ) }}/{{$result->avatar}}" alt="{{$result->username}}"></a>
        </div>
        <div class="media-body">
            <a href="{{route('home.profile',$result->id)}}">{{$result->username}}</a>
            <div class="info">
                <span class="text-muted" >تهران، تهران</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>
@endif
    @if($section=='products')
        <li>
            <div class="media">
                <div class="media-right">
                    <a href="{{route('home.shop.product',[$result->shop->id,$result->id])}}"><img class="media-object img-circle" src="{{ asset('img/files/shop' ) }}/{{$result->files()->first()->name}}" alt="{{$result->name}}"></a>
                </div>
                <div class="media-body">
                    <a href="{{route('home.shop.product',[$result->shop->id,$result->id])}}">{{$result->name}}</a>
                    <div class="info">
                        <span class="text-muted" >تهران، تهران</span>&ensp;
                        {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                        {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
                    </div>
                </div>
            </div>
        </li>
    @endif
@endforeach
@else
<li>
    <div class="media">
        <div class="media-body text-center find-friend-dropdown">
            <h3>نتیجه ای یافت نشد.</h3>
            <h5>با جزئیات بیشتر و پیشرفته تر جستجو کنید.</h5>
            <a href="{{ route('search.index') }}" class="btn btn-violet">جستجوی پیشرفته</a>
        </div>
    </div>
</li>
    @endif