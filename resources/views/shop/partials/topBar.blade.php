<div class="top-info-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 pull-right">
                <ul class="contact-box">
                    <li><i class="fa fa-phone fa-rotate-270" ></i> شماره تماس : {{ $shop->phone }}</li>
                    <li><i class="fa fa-envelope-o" ></i>آدرس ایمیل : {{ $shop->user->email }}</li>
                    <li><i class="fa icon-user-1" ></i><a target="_blank" href="{{ route('home.profile', $shop->user_id) }}" >پروفایل {{ $shop->user->username }}</a></li>
                </ul>
            </div>
            <div class="col-sm-4 pull-left text-left">
                <div class="top-rate">
                    <span>امتیاز فروشگاه</span>
                    <div class="shop-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
            </div>
        </div>
    </div>

</div>