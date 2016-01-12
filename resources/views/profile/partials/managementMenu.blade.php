<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">مدیریت پروفایل</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li class="{{ (strpos(URL::current(),route('profile.management.credit')) !== false) ? 'active' : '' }}"><i class="fa fa-credit-card" ></i><a href="{{ route('profile.management.credit') }}" class="">حساب مالی من</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.accountant')) !== false) ? 'active' : '' }}"><i class="fa fa-bank" ></i><a href="{{ route('profile.management.accountant') }}" class="">مدیریت تراکنش های مالی</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.storage')) !== false) ? 'active' : '' }}"><i class="fa fa-database" ></i><a href="{{ route('profile.management.addon.storage') }}" class="">مدیریت افزونه افزایش حجم</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.poll')) !== false) ? 'active' : '' }}"><i class="fa fa-bar-chart-o" ></i><a href="{{ route('profile.management.addon.poll') }}" class="">مدیریت افزونه نظر سنجی</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop')) !== false) ? 'active' : '' }}"><i class="fa fa-shopping-cart" ></i><a href="{{ route('profile.management.addon.shop') }}">مدیریت افزونه فروشگاه</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.offer')) !== false) ? 'active' : '' }}"><i class="fa fa-diamond" ></i><a href="{{ route('profile.management.addon.offer') }}" class="">مدیریت افزونه پیشنهاد ویژه</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.relater')) !== false) ? 'active' : '' }}"><i class="fa fa-diamond" ></i><a href="{{ route('profile.management.addon.relater') }}" class="">مدیریت افزونه افزایش رتیه پروفایل</a></li>
                <li><i class="fa fa-user-secret" ></i><a class="">مدیریت افزونه تبلیغ پروفایل ها</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.advertise')) !== false) ? 'active' : '' }}"><i class="fa fa-flag-checkered" ></i><a href="{{ route('profile.management.addon.advertise') }}" class="">مدیریت افزونه تبلیغ در صفحه اول</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.profit')) !== false) ? 'active' : '' }}"><i class="fa fa-rocket" ></i><a href="{{ route('profile.management.addon.profit') }}" class="">مدیریت افزونه افزایش رتبه جستجو</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.recruitment')) !== false) ? 'active' : '' }}"><i class="fa fa-rocket" ></i><a href="{{ route('profile.management.addon.recruitment') }}" class="">مدیریت افزونه آگهی استخدام</a></li>
            </ul>
        </div>
    </div>
</div>