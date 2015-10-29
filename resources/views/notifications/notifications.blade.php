@if(count($notifications))
    @foreach($notifications as $notification)
        {!! $notification !!}
    @endforeach
@else
    <li>
        <div class="media">
            <div class="media-body text-center find-friend-dropdown">
                <div class="fa fa-bullhorn fa-5x"></div>
                <h3>اطلاعیه جدید وجود ندارد.</h3>
                <h5>همین حالا دوستان جدید پیدا کنید</h5>
                <a href="#" class="btn btn-violet">یافتن دوستان جدید</a>

            </div>
        </div>
    </li>
@endif