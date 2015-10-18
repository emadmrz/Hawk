<div class="timeline-block" id="add_new_post">
    <div class="panel panel-default share clearfix-xs">
        {!! Form::open(['route'=>'profile.post.add', 'method'=>'post']) !!}
        <div class="panel-heading panel-heading-gray title">
            پست جدید
        </div>
        <div class="panel-body">
            <div id="post_banner" class=""></div>
            <div class="" id="post_text_container">
                <textarea name="content" id="flex_textarea" class="form-control share-text" rows="3" placeholder="شما هم می توانید نگاره ای به اشتراک بگذارید..."></textarea>
                <input type="hidden" name="location" value="" id="my_location_value">
                <input type="hidden" name="image" value="" id="post_image_value">
            </div>
        </div>
        <div class="panel-footer share-buttons">
            <a href="" ><i class="fa fa-photo"><input type="file" name="postImage" id="postImage" class="inline-file"></i></a>
            <a href="" id="myLocation"><i class="fa fa-map-marker"></i></a>
            <button id="post_submit_btn" type="submit" class="btn btn-teal btn-xs pull-right display-none" >ارسال</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>