<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">تنظیمات پروفایل</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li class="{{ (strpos(URL::current(),route('profile.setting.password')) !== false) ? 'active' : '' }}"><i class="fa fa-lock" ></i><a href="{{ route('profile.setting.password') }}" class="">تغییر کلمه عبور</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.setting.storage')) !== false) ? 'active' : '' }}"><i class="fa fa-database" ></i><a href="{{ route('profile.setting.storage') }}" class="">مدیریت حجم پروفایل</a></li>
                <li><i class="fa fa-shield" ></i><a class="">مدیریت حریم خصوصی</a></li>
                <li><i class="fa fa-bug" ></i><a class="">گزارش خطاها و باگ های برنامه</a></li>
                <li><i class="fa fa-user-times" ></i><a class="">غیرفعال سازی حساب کاربری</a></li>
            </ul>
        </div>
    </div>
</div>