<div class="timeline-block" id="add_new_post">
    <div class="panel panel-default share clearfix-xs">

        <div class="panel-heading panel-heading-gray title">
            ثبت پرسش جدید
        </div>
        <div class="panel-body">
            <div id="post_banner" class=""></div>
            <div class="" id="problem_text_container">
                {!! Form::open(['route'=>['group.problem.add',$group->id], 'method'=>'post', 'id'=>'problem_form']) !!}
                    <textarea name="content" id="flex_textarea" class="form-control share-text" rows="3" placeholder="شما هم می توانید پرسشی را مطرح کنید ..."></textarea>
                    <div id="images_list">

                    </div>
                {!! Form::close() !!}
                <div class="attachment" style="margin-bottom: 15px">
                    {!! Form::open(['route'=>'files.problem.attachment', 'class'=>'form-inline', 'data-remote-file']) !!}
                    <div class="form-group">
                        <label class="pull-right" for="attachment">انتخاب ضمیمه : </label>
                        <div class="col-sm-7 pull-right">
                            <input type="file" name="attachment" id="attachment" class="form-control input-sm">
                        </div>
                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-plus" ></i> افزودن ضمیمه </button>
                    </div>
                    {!! Form::close() !!}
                    <div class="attachments-list">
                        <ul>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel-footer share-buttons">
            <button id="problem_submit_btn" type="submit" class="btn btn-teal btn-xs pull-right display-none" >ارسال</button>
        </div>

    </div>
</div>