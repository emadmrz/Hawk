@cannot('join-group', $group)
<div class="form-group">
    <a class="btn btn-violet btn-block" href="{{ route('group.problem.create', $group->id) }}"><i class="fa fa-question-circle fa-lg"></i> طرح پرسش جدید در گروه </a>
</div>
@endcan