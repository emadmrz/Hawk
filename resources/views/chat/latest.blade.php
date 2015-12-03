@if(count($histories))
    @foreach($histories as $history)
        {!! $history !!}
    @endforeach
    <li>
        <div class="media">
            <div class="media-body text-center find-friend-dropdown">
                <a href="{{ route('chat.index') }}" class="btn btn-default text-muted">ورود به بخش گفتگو</a>
            </div>
        </div>
    </li>
@else
    <li>
        <div class="media">
            <div class="media-body text-center find-friend-dropdown">
                <div class="fa fa-bullhorn fa-5x"></div>
                <h3>شما تا کنون پیام نداشته اید.</h3>
                <h5>دوستان جدید بیابید و با آنها گفتگو کنید!</h5>
                <a href="#" class="btn btn-violet">یافتن دوستان جدید</a>
                <a href="#" class="btn btn-default text-muted">ورود به بخش گفتگو</a>
            </div>
        </div>
    </li>
@endif