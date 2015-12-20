<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$showcase->profile_id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$showcase->profile->avatar ) }}" alt="{{ $showcase->profile->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$showcase->profile_id]) }}"> {{ $showcase->profile->username }} </a>
             درخواست تبلیغ شما را تایید کرد. شما می توانید با پرداخت هزینه آن، تبلیغ خود را در صفحه او ببینید.
            <p>
                <a class="btn btn-info btn-xs" href="{{ route('store.showcase', $showcase->id) }}">پرداخت هزینه</a>
            </p>
            <div class="info">
                <span class="date" >{{ $showcase->shamsi_human_updated_at }}</span>&ensp;
            </div>
        </div>
    </div>
</li>