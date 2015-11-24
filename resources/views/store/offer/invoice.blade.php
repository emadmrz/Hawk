<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            {{ $coupon->title }}
        </div>
        <div class="panel-body">

            <div class="clearfix" style="border: 2px dashed #DDD; border-radius: 5px; padding: 10px">

                <div class="col-sm-6 text-muted">
                    <img class="img-responsive img-rounded" src="{{ asset('img/files/'.$gallery->image) }}"><hr>
                    <p><strong>عنوان خدمت : </strong> {{ $gallery->title }} </p>
                    <p>{{ $gallery->description }}</p>
                    <p><strong>تاریخ انقضاء : </strong> {{ $gallery->shamsi_expired_at }} ({{ $coupon->diff_expired_at }} دیگر ) </p>
                </div>

                <div class="col-sm-6">
                    <div class="clearfix form-horizontal">

                        <p class="text-muted">{{ $coupon->description }}</p>
                        <div><strong>ارزش کوپن : </strong> <h4 class="text-danger" style="display: inline-block">{{ $coupon->real_amount }} تومان </h4>  </div>
                        <div><strong>مبلغ قابل پرداخت : </strong> <h4 class="text-success" style="display: inline-block">{{ $coupon->pay_amount }} تومان </h4>  </div>
<br>
                        {!! Form::open(['route'=>['home.profile.offer.coupon.buy',$user->id, $offer->id, $coupon->id], 'method'=>'get']) !!}
                        <p class="">
                            <strong class="">نحوه پرداخت هزینه کوپن : </strong>
                            <div class="center-block">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="paymentRadio1" value="mellat" name="payment_gate" >
                                    <label for="paymentRadio1"><img width="30px" src="{{ asset('img/icons/mellat.png') }}" title="درگاه پرداخت بانک ملت" >&ensp; پرداخت اینترنتی از درگاه بانک ملت </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="paymentRadio2" value="in-place" name="payment_gate" >
                                    <label for="paymentRadio2">پرداخت در محل ارائه کوپن</label>
                                </div>
                            </div>
                        </p>

                        <button type="submit" class="btn btn-violet" ><i class="fa fa-money"></i> دریافت کوپن </button>

                        {!! Form::close() !!}

                    </div>
                </div>

            </div>

        </div>
        <div class="panel-footer text-center">
            {{--<a class="see-more" href="{{ route('home.articles', [$user->id]) }}"><i class="fa fa-plus fa-1x"></i>مشاهده سایر مقالات</a>--}}
        </div>
    </div>
</div>