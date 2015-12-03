    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                پیشنهاد سایت
            </div>
            <div class="panel-body" id="friendship_list">
                <div class="list-item-image">

                    <ul class="">
                        @foreach($mutuals as $friend)
                            <li>
                                <div class="media">
                                    <div class="media-right">
                                        <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$friend->friend_info->avatar ) }}" alt="{{ $friend->friend_info->username }}"></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"> {{ $friend->friend_info->username }} </a>

                                        </div>
                                            <div class="actions">
                                                {!! Form::open(['route'=>'home.friend.suggestRequest','data-remote-multiple']) !!}
                                                <input type="hidden" name="profile" value="{{ $friend->friend_info->id }}">
                                                <button type="submit" class="btn btn-violet btn-xs"><i class="fa fa-user-plus"></i>ارسال درخواست دوستی </button>
                                                {!! Form::close() !!}
                                            </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-footer ">
                <i class="fa icon-information fa-lg" ></i>
                درخواست های دوستی خود را مدیریت کنید و دوستان جدید برای خود پیدا نمایید.
            </div>
        </div>
    </div>