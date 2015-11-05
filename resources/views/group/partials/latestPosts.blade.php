<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            آخرین پست ها
        </div>
        <div class="panel-body">
            <div class="list-item">
                <ul class="">
                    @foreach($group->posts as $post)
                        <li>
                            <a class="title" href="{{ route('group.post.preview',[$post->parentable_id, $post->id]) }}">{{ str_limit($post->content,100) }}</a>
                            <div class="date">{{ $post->shamsi_create_at }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer text-center">

            <a class="see-more" href="#"><i class="fa fa-plus fa-1x"></i> مشاهده آخرین پست ها </a>
        </div>
    </div>
</div>