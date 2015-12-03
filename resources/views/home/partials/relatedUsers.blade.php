@foreach($relatedUsers as $user)
    <div class="search-result clearfix" style="margin-top: 15px">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{asset('img/persons/')}}/{{$user->avatar}}">
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




