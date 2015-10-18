<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">مدیریت پروفایل</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li class="{{ (strpos(URL::current(),route('profile.management.accountant')) !== false) ? 'active' : '' }}"><i class="fa fa-bank" ></i><a href="{{ route('profile.management.accountant') }}" class="">مدیریت تراکنش های مالی</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.storage')) !== false) ? 'active' : '' }}"><i class="fa fa-database" ></i><a href="{{ route('profile.management.addon.storage') }}" class="">مدیریت افزونه افزایش حجم</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.poll')) !== false) ? 'active' : '' }}"><i class="fa fa-bar-chart-o" ></i><a href="{{ route('profile.management.addon.poll') }}" class="">مدیریت افزونه نظر سنجی</a></li>
                <li><i class="fa fa-shopping-cart" ></i><a class="">مدیریت افزونه فروشگاه</a></li>
                <li><i class="fa fa-diamond" ></i><a class="">مدیریت افزونه پیشنهاد ویژه</a></li>
                <li><i class="fa fa-user-secret" ></i><a class="">مدیریت افزونه تبلیغ پروفایل ها</a></li>
                <li><i class="fa fa-flag-checkered" ></i><a class="">مدیریت افزونه تبلیغ در صفحه اول</a></li>
                <li><i class="fa fa-rocket" ></i><a class="">مدیریت افزونه افزایش رتبه جستجو</a></li>
            </ul>
        </div>
    </div>
</div>