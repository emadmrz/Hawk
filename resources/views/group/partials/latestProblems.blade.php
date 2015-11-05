<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            آخرین پرسش ها
        </div>
        <div class="panel-body">
            <div class="list-item">
                <ul class="">
                    @foreach($group->problems as $problem)
                        <li>
                            <a class="title" href="{{ route('group.problemPreview',[$problem->parentable->id, $problem->id]) }}">{{ str_limit($problem->content,100) }}</a>
                            <div class="date">{{ $problem->shamsi_create_at }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer text-center">

            <a class="see-more" href="#"><i class="fa fa-plus fa-1x"></i>مشاهده تمامی پرسش ها</a>
        </div>
    </div>
</div>