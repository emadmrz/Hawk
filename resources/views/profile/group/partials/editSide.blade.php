<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">مدیریت گروه</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li><a href="{{route('profile.group.edit',[$group->id])}}"><i class="fa fa-pencil"></i> ویرایش گروه </a></li>
                <li><a href="{{route('profile.group.image.create',[$group->id])}}"><i class="fa fa-image"></i> انتخاب تصویر برای گروه </a></li>
                <li><a href="{{route('group.index',[$group->id])}}"><i class="fa fa-eye"></i> مشاهده گروه </a></li>
                <li><a href="{{route('profile.group.delete',[$group->id])}}"><i class="fa fa-trash-o"></i>  حذف گروه </a></li>
            </ul>
        </div>
    </div>
</div>