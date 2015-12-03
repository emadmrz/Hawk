<div class="stream friendship ">
    <div class="sender">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $corporation->sender->username }}" src="{{ asset('img/persons/'.$corporation->sender->avatar) }}">
    </div>
    <div class="receiver">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $corporation->receiver->username }}" src="{{ asset('img/persons/'.$corporation->receiver->avatar) }}">
    </div>
    <div class="title medium">
        <a href="{{ route('home.profile', $corporation->receiver_id) }}">{{ $corporation->receiver->username }}</a>
        تقاضای شما را برای همکاری در زمینه
        <a href="#">{{ $corporation->skill->title }}</a>
        را پذیرفت .
        @if(!$corporation->question_completed)
            <a href="{{route('profile.corporation.question.index',[$corporation->id])}}" style="color: white" class="btn btn-violet btn-xs pull-left">تکمیل پرسشنامه</a>
        @else
            <a href="{{route('profile.corporation.question.show',[$corporation->id])}}" style="color: white" class="btn btn-violet btn-xs pull-left">مشاهده پرسشنامه</a>
        @endif
    </div>
</div>