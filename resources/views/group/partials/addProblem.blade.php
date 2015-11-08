@cannot('join-group', $group)
<p class="text-muted" style="font-size: 12px; text-align: justify">
    در صورت داشتن سوال مرتبط با فعالیت گروه می توانید آن را برای کاربران مطرح کنید و در بین پاسخ ها، بهترین را انتخاب نمایید.
</p>
<div class="form-group">
    <a class="btn btn-violet btn-block" href="{{ route('group.problem.create', $group->id) }}"><i class="fa fa-question-circle fa-lg"></i> طرح پرسش جدید در گروه </a>
</div>
@endcan