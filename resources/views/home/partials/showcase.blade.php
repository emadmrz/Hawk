<div class="form-group">
    <a class="btn btn-violet btn-block" href="{{ route('home.profile.showcase', [$user->id]) }}"><i class="fa fa-bullhorn fa-lg"></i> در این پروفایل دیده شوید </a>
    <p class="text-muted" style="font-size: 12px; text-align: justify; margin-top: 5px">
        @if($showcase_reserve)
            {{ $showcase_reserve }} نفر در صف انتظار برای تبلیغ در این پروفایل هستند.
        @else
            شما می توانید پروفایل خودتان را در این پروفایل تبلیغ کنید. برای این منظور درخواست تبلیغ برای صاحب پروفایل ارسال نمایید.
        @endif
    </p>
</div>