<li>
    <div class="media">
        <div class="media-right">
            <a href="#"><img class="media-object img-circle" src="{{ asset('img/persons/1.jpg' ) }}" alt="username"></a>
        </div>
        <div class="media-body">
            <a href="#">عماد خان میرزایی</a>
            <div class="info">
                <span class="text-muted" >تهران، تهران</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>

<li>
    <div class="media">
        <div class="media-right">
            <a href="#"><img class="media-object img-circle" src="{{ asset('img/persons/1.jpg' ) }}" alt="username"></a>
        </div>
        <div class="media-body">
            <a href="#">عماد خان میرزایی</a>
            <div class="info">
                <span class="text-muted" >تهران، تهران</span>&ensp;
            </div>
        </div>
    </div>
</li>

<li>
    <div class="media">
        <div class="media-body text-center find-friend-dropdown">
            <h3>نتیجه ای یافت نشد.</h3>
            <h5>با جزئیات بیشتر و پیشرفته تر جستجو کنید.</h5>
            <a href="{{ route('search.index') }}" class="btn btn-violet">جستجوی پیشرفته</a>
        </div>
    </div>
</li>