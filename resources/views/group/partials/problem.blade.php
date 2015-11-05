<div class="timeline-block" id="add_new_post">
    <div class="panel panel-default share clearfix-xs">
            {!! Form::open(['route'=>['group.problem.add',$group->id], 'method'=>'post']) !!}
        <div class="panel-heading panel-heading-gray title">
            ثبت پرسش جدید
        </div>
        <div class="panel-body">
            <div id="post_banner" class=""></div>
            <div class="" id="post_text_container">
                <textarea name="content" id="flex_textarea" class="form-control share-text" rows="3" placeholder="شما هم می توانید پرسشی را مطرح کنید ..."></textarea>

            </div>
        </div>
        <div class="panel-footer share-buttons">
            <button id="post_submit_btn" type="submit" class="btn btn-teal btn-xs pull-right display-none" >ارسال</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>