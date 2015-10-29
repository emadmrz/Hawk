<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">مدیریت پنل فروشگاه</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.edit', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-shopping-cart" ></i><a href="{{ route('profile.management.addon.shop.edit', $shop->id) }}" class="">ویرایش اطلاعات فروشگاه</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.images', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-image" ></i><a href="{{ route('profile.management.addon.shop.images', $shop->id) }}" class="">بنر فروشگاه</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.products', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-database" ></i><a href="{{ route('profile.management.addon.shop.products', $shop->id ) }}" class="">مدیریت و ویرایش کالاها</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.product.create', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-bar-chart-o" ></i><a href="{{ route('profile.management.addon.shop.product.create', $shop->id ) }}" class="">ثبت کالای جدید  </a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.commercial', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-bullhorn" ></i><a href="{{ route('profile.management.addon.shop.commercial', $shop->id ) }}" class="">ثبت آگهی در فروشگاه</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.aboutus', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-info-circle" ></i><a href="{{ route('profile.management.addon.shop.aboutus', $shop->id ) }}" class="">ویرایش صفحه درباره ما</a></li>
                <li class="{{ (strpos(URL::current(),route('profile.management.addon.shop.contactus', $shop->id )) !== false) ? 'active' : '' }}"><i class="fa fa-phone" ></i><a href="{{ route('profile.management.addon.shop.contactus', $shop->id ) }}" class="">ویرایش صفحه ارتباط با ما</a></li>
            </ul>
        </div>
    </div>
</div>