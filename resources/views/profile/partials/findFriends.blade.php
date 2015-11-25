@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                نتایج جستجو
            </div>
            <div class="panel-body" id="friendship_list">
                <div class="list-item-image">



                    <ul class="">
                        @if(count($results))
                            @foreach($results as $friend)
                                <li>
                                    <div class="media">
                                        <div class="media-right">
                                            <a href="{{ route('home.profile', [$friend->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$friend->avatar ) }}" alt="{{ $friend->username }}"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <a href="{{ route('home.profile', [$friend->id]) }}"> {{ $friend->username }} </a>

                                            </div>


                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            @else
                            <div class="media">
                                <div class="media-body text-center find-friend-dropdown">
                                    <div class="fa fa-frown-o fa-5x"></div>
                                    <h3>در Skillema تنها نباشید</h3>
                                    <h5>همین حالا دوستان جدید پیدا کنید</h5>
                                    <a href="{{route('profile.friend.find')}}" class="btn btn-violet col-sm-4 col-sm-offset-4">پیشنهاد سایت</a>

                                </div>
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-footer ">
                <i class="fa icon-information fa-lg" ></i>
                درخواست های دوستی خود را مدیریت کنید و دوستان جدید برای خود پیدا نمایید.
            </div>
        </div>
    </div>
@endsection