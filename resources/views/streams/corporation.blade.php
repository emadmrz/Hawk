<div class="stream friendship ">
    <div class="sender">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $corporation->sender->username }}" src="{{ asset('img/persons/'.$corporation->sender->avatar) }}">
    </div>
    <div class="receiver">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $corporation->receiver->username }}" src="{{ asset('img/persons/'.$corporation->receiver->avatar) }}">
    </div>
    <div class="title medium">
        <a href="{{ route('home.profile', $corporation->sender_id) }}">{{ $corporation->sender->username }}</a>
        تمایل دارد در زمینه
        <a href="#">{{ $corporation->skill->title }}</a>
        با شما همکاری نماید
        <a href="{{route('profile.corporation.index',[$corporation->id])}}" class="btn btn-info btn-xs pull-left">مشاهده جزئیات</a>
    </div>
</div>