<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills violet skill-step nav-justified thumbnail setup-panel">
            <li @if($step == 1)class="active"@endif><a >
                    <h4 class="list-group-item-heading">گام اول</h4>
                    <p class="list-group-item-text">ویرایش اطلاعات کالا</p>
                </a></li>
            <li @if($step == 2)class="active"@endif><a >
                    <h4 class="list-group-item-heading">گام دوم</h4>
                    <p class="list-group-item-text">ویژگی های کالا</p>
                </a></li>
            <li @if($step == 3)class="active"@endif><a >
                    <h4 class="list-group-item-heading">گام سوم</h4>
                    <p class="list-group-item-text">تصاویر کالا</p>
                </a></li>
        </ul>
    </div>
</div>