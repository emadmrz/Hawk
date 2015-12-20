<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">تبلیغات در پروفایل</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.showcase.myRequest')) !== false) ? 'active' : '' }}"><i class="fa fa-credit-card" ></i><a href="{{ route('profile.management.addon.showcase.myRequest') }}" class="">درخواست های من</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.showcase.requestToMe')) !== false) ? 'active' : '' }}"><i class="fa fa-bank" ></i><a href="{{ route('profile.management.addon.showcase.requestToMe') }}" class="">تبلیغ در پروفایل من</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.showcase.active')) !== false) ? 'active' : '' }}"><i class="fa fa-database" ></i><a href="{{ route('profile.management.addon.showcase.active') }}" class="">تبلیغات من</a></li>
            </ul>
        </div>
    </div>
</div>