<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">مدیریت گروه</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li><a href="{{route('profile.group.image.create',[$group->id])}}">انتخاب تصویر برای گروه</a></li>
                <li><a href="{{route('profile.group.delete',[$group->id])}}">حذف گروه</a></li>
            </ul>
        </div>
    </div>
</div>