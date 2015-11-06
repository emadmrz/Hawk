<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>شبکه اجتماعی مهارت ایرانیان</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/raterater.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

</head>
<body>


<header id="site-header" class="site-header @if(Auth::check()) profile-header @endif">

    @include('partials.navbar')

    <div class="text-center fly-text clearfix">

        <div class="logo">
            <img src="{{ asset('img/logo/skillema.png') }}">
        </div>


        <h1>شبکه اجتماعی مهارت ایرانیان (نسخه آزمایشی)</h1>

        <form class="main-search-form" >
            <div class="form-group">
                <div class="">
                    <div class="col-sm-5" style="margin-left: 29%;">
                        <input type="text" name="search" id="search_field" class="form-control search-box" placeholder="همین الان مهارتی که نیاز دارید را جستجو کنید...">
                        <button type="submit" class="search-now"><i class="fa fa-search fa-lg"></i></button>
                    </div>
                       <span class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 10px ">
                           <span id="products" class="img-circle search-filter product pull-left"  data-toggle="tooltip" data-placement="bottom" title=" در بین کالاها " ><i class="fa fa-shopping-cart fa-2x"></i></span>
                           <span id="users" class="img-circle search-filter bottom active person  pull-left"  data-toggle="tooltip" data-placement="bottom" title="در بین متخصصین"  ><i class="fa fa-user fa-2x"></i></span>
                       </span>
                </div>
            </div>
        </form>



    </div>


    <div class="container">
        <div class="row">

            <div id="carousel-example-generic" class="carousel slide  adv-carousel" data-ride="carousel">

                <div class="carousel-inner" role="listbox">
                    <?php $key = 0; ?>
                    @foreach($output as $key => $advertise)
                        @if($key == 0)
                            <div class="item active">
                        @elseif($key % 5 == 0)
                            <div class="item">
                        @endif

                            <div class="col-lg-2  col-md-2 col-sm-3">
                                <div class="adv-card">
                                    <div class="avatar">
                                         <a href="{{ route('home.profile', $advertise->user_id) }}"><img src="{{ asset('img/persons/'.$advertise->user->avatar) }}" class="img-circle"></a>
                                    </div>
                                    <a href="{{ route('home.profile', $advertise->user_id) }}" class="title">{{ $advertise->user->username }}</a>
                                    @if(count($advertise->user->skill))
                                        <div class="info">{{ $advertise->user->skill->first()->title }}</div>
                                    @else
                                        <div class="info">بدون مهارت</div>
                                    @endif
                                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                                </div>
                            </div>


                        @if($key % 5 == 0 and $key > 5)
                            </div>
                        @endif
                    @endforeach
                        @if($key % 5 != 0 or $key == 0)
                            </div>
                        @endif


                </div>


                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>


            </div>

        </div>
    </div>


</header>

<main class="site-main">

    <!-- Info Circles -->

    <div class="info-circles" >
        <div class="container">

            <div class="row">
                <div class="jumbotron text-center">
                    <h2>یک سفر هزار مایلی با اولین قدم شروع می شود
                        <div class="little-logo"><img src="{{ asset('img/logo/ema-small.png') }}"></div>
                    </h2>

                    <div class="our-duty">
                        <div class="row">

                            <div class="col-sm-2 duty-circle">
                                <a href="#" data-role="0" class="img-circle orange" >
                                    <div class="duty-info">
                                        <img src="{{ asset('img/icons/handshake2.png') }}">
                                        <div class="title"> ارتباط با مشتری ها </div>
                                    </div>
                                </a>

                            </div>

                            <div class="col-sm-2 duty-circle">
                                <a href="#" data-role="1" class="img-circle green" >
                                    <div class="duty-info">
                                        <i class="fa fa-bullhorn fa-5x"></i>
                                        <div class="title">معرفی خود و کسب و کارتان</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2 duty-circle">
                                <a href="#"  data-role="2" class="img-circle teal" >
                                    <div class="duty-info">
                                        <i class="fa fa-bank fa-5x" style="left: 5px;"></i>
                                        <div class="title">تبادل اطلاعاتتان</div>
                                    </div>
                                </a>

                            </div>

                            <div class="col-sm-2 duty-circle">
                                <a href="#"  data-role="3" class="img-circle blue" >
                                    <div class="duty-info">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                        <div class="title" >فروشگاه خصوصی تان</div>
                                    </div>
                                </a>

                            </div>

                            <div class="col-sm-2 duty-circle">
                                <a  data-role="4" href="#" class="img-circle violet">
                                    <div class="duty-info">
                                        <i class="fa fa-diamond fa-5x"></i>
                                        <div class="title" >بانک اطلاعاتی مهارت هایتان</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2 duty-circle">
                                <a  data-role="5" href="#" class="img-circle red">
                                    <div class="duty-info">
                                        <i class="fa fa-users fa-5x"></i>
                                        <div class="title" >شبکه اجتماعی از دوستانتان</div>
                                    </div>
                                </a>
                            </div>

                        </div>


                    </div>

                    <div style="height: 70px">
                        <div id="carousel-text-slide" class="carousel  carousel-fade hidden" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active" id="caro-customer">
                                    <h3 style="margin-top:10px ; font-family: web-yekan; line-height: 28px ; font-size: 20px; height: 50px">Skillema  پلی است بین شما و کسانی که خواهان تخصص و مهارت شما هستند. در اینجا مشتریان شما به راحتی و بطور رایگان با شما و مهارت هایتان آشنا می شوند و کار خود را به شما می سپارند.</h3>
                                </div>
                                <div class="item" id="caro-work">
                                    <h3 style="margin-top:10px ; font-family: web-yekan; line-height: 28px ; font-size: 20px; height: 50px">Skillema  محیطی است که در آن شما می توانید صاحب کسب و کار خودتان باشید. یعنی می توانید خودتان را معرفی کنید، تبلیغ و بازاریابی کنید، با مشتریانتان تعامل کنید، آخرین وضعیت خود را ارزیابی کنید و ...</h3>
                                </div>
                                <div class="item">
                                    <h3 style="margin-top:10px ; font-family: web-yekan; line-height: 28px ; font-size: 20px; height: 50px"  >Skillema  محیطی است برای تبادل دانش و تجربیات تان با دیگران. ما می خواهیم پایگاهی برای اشتراک رایگان دانش و تجربه به شما  و مرحله به مرحله در مسیر رشد ماهرت هایتان در کنارتان باشیم</h3>
                                </div>
                                <div class="item">
                                    <h3 style="margin-top:10px ; font-family: web-yekan; line-height: 28px ; font-size: 20px; height: 50px"  >Skillema  محیطی است برای عرضه هنر و صنعت شما به مشتریان تان. شما می توانید فروشگاه شخصی خودتان را راه اندازی کنید و از این طریق  کسب درآمد کنید.</h3>
                                </div>
                                <div class="item">
                                    <h3 style="margin-top:10px ; font-family: web-yekan ; line-height: 28px ; font-size: 20px; height: 50px"  >Skillema  یک بانک اطلاعاتی قدرتمند و جامع ترین روش برای دستیابی به مهارت هایی است که شما نیاز دارید ما افتخار می کنیم که خود را جامعه بزرگی از صاحبان مهارت بدانیم.</h3>
                                </div>
                                <div class="item">
                                    <h3 style="margin-top:10px ; font-family: web-yekan ; line-height: 28px ; font-size: 20px; height: 50px"  >Skillema  یک شبکه اجتماعی قدرتمند است برای پیدا کردن و ارتباط با دوستانی متخصص و ماهر که به شما می آموزند و از شما یاد می گیرند.</h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<button style="margin-top: 20px" class="btn btn-success btn-lg">همین حالا شروع کنید</button>-->

                </div>
            </div>


        </div>
    </div>

    <!-- Our Network States -->
    <div id="promotion-stats">
        <div class="container">

        </div>
    </div>

</main>


<footer class="footer">
    <div class="container">

        <div class="col-lg-5 col-md-3 col-sm-4">
            <div class="logo col-lg-8 col-md-12 col-sm-12">
                <img src="{{ asset('img/logo/skillema_gray.png') }}">
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4">
            <div class="menu">
                <h4 class="title">شبکه اجتماعی مهارت</h4>
                <ul>
                    <li><a href="#">متخصص کیست ؟</a></li>
                    <li><a href="#">متخصصین حقوقی</a></li>
                    <li><a href="#">روش های کسب و کار</a></li>
                    <li><a href="#">تبلیغات و بازاریابی</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4">
            <div class="menu">
                <h4 class="title">درباره ما</h4>
                <ul>
                    <li><a href="#" >از کجا شروع کردیم ؟</a></li>
                    <li><a href="#" >همکاران و شرکت کنندگان</a></li>
                    <li><a href="#">فرصت های شغلی</a></li>
                    <li><a href="#">تماس با ما</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-md-3">
            <div class="social-media">
                <h3 class="title">ما را دنبال کنید</h3>
                <ul>
                    <li class="facebook"><a href="#" class="fa fa-facebook fa-2x"></a></li>
                    <li class="twitter"><a href="#" class="fa fa-twitter fa-2x"></a></li>
                    <li class="youtube"><a href="#" class="fa fa-youtube fa-2x"></a></li>
                    <li class="whatsapp"><a href="#" class="fa fa-whatsapp fa-2x"></a></li>
                </ul>
                <p class="text-muted">با اشتراک گذاری و افزایش محبوبیت ما در شبکه های اجتماعی، شما هم در پیشرفت ما سهیم باشد.</p>
            </div>
        </div>

    </div>
    <div class="copyright">
        <div class="container">
            <div class="text-center">کلیه حقوق مادی و معنوی این شبکه در اختیار Skillema بوده و هر گونه کپی برداری غیر مجاز است.<div class="pull-left">© کپی رایت ۱۳۹۴</div></div>

        </div>
    </div>
</footer>


<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/raterater.js') }}"></script>


<script>
    function rateAlert(id, rating)
    {
        alert( 'Rating for '+id+' is '+rating+' stars!' );
    }

    /* Here we initialize raterater on our rating boxes
     */
    $(function() {
        $( '.user-rate' ).raterater( {
            submitFunction: 'rateAlert',
            allowChange: true,
            starWidth: 20,
            spaceWidth: 5,
            numStars: 5
        } );
    });

    $(document).ready(function(){

        $('.duty-circle a').hover(
                function() {
                    var role = $(this).attr('data-role');
                    role= parseInt(role);
                    $('#carousel-text-slide').carousel(role);
                    $('#carousel-text-slide').carousel('pause');
                    $('#carousel-text-slide').removeClass('hidden');
                }, function() {
                    $('#carousel-text-slide').carousel('cycle');
                    $('#carousel-text-slide').addClass('hidden');
                }
        );

        $(function () {
//            $('[data-toggle="tooltip"]').tooltip()
        });

        $(function () {
            $('[data-toggle="popover"]').popover()
        })

        $('#carousel-example-generic').carousel({
            interval: 10000 ,
            duration: 1500
        })

        $('#carousel-text-slide').carousel({
            interval: 5000 ,
            duration: 600
        })

        $('#users').click(function(){
            $('#users').addClass('active');
            $('#products').removeClass('active');
            $("#search_field").attr('placeholder' , 'همین الان مهارتی که نیاز دارید را جستجو کنید...' );
        });
        $('#products').click(function(){
            $('#users').removeClass('active');
            $('#products').addClass('active');
            $("#search_field").attr('placeholder' , 'همین الان کالایی که نیاز دارید را جستجو کنید...' );
        });
    });

</script>


</body>
</html>