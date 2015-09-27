<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeading5" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup5" aria-expanded="true" aria-controls="collapseListGroup5">مجموعه ما روی نقشه
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroup5" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
            <div class="">
                <div class="google-map-canvas" id="map-canvas"></div>
            </div>
        </div>
        <div class="panel-footer clearfix">
            {!! Form::open(['route'=>'profile.location.store', 'id'=>'my_location_form', 'data-remote']) !!}
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lng" name="lng" value="">
            <button type="submit" class="btn btn-success btn-xs pull-right display-none" ><i class="fa fa-save" ></i> ذخیره کردن موقعیت   </button>
            {!! Form::close() !!}
            <button id="MyLocation" type="button" class="btn btn-teal btn-xs pull-left display-none" > موقعیت کنونی من </button>
            <div id="MapReport" class="reports" ></div>
        </div>
    </div>
</div>