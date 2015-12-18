<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="description" content="Skillema یک شبکه اجتماعی تخصصی برای کاربران فارسی زبان، خصوصاً ایرانیان است. حضور در فضای مجازی و دارا بودن صفحات مجازی برای رونق کسب و کار کسانی که دارای مهارت های مشخصی بوده امری مهم است. از طرفی صاحبان مهارت و کسب و کار علاقه دارند تا در قالب یک سیستم یکپارچه وضعیت خود را ارزیابی نموده و جایگاه خود را نسبت به سایرین ارتقاء دهند. لذا بستری مناسب که پاسخگوی نیاز های فوق برای صاحبان فن و مهارت های کسب و کار باشد را در قالب شبکه اجتماعی تحت عنوان Skillema ایجاد شد.">
    <meta name="keywords" content="skillema,skilema,skill,ability,social network,social media,شبکه اجتماعی,مهارت,توانایی,اسکیل ما,اسکلیما,مهارت ورزی,فروشگاه,فنی,مهندسی,شلوغش کن,استخدام,مهندس,تکنولوژی,گروه,چت,رضایت مشتری,فرهنگی و هنری,مدیریت و مشاوره,هوش مصنوعی,برنامه نویسی,لاراول,laravel,افزونه,کسب درآمد,کسب و کار,استارت آپ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>شبکه اجتماعی مهارت های ایرانی</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/invitation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body>


<nav id="nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img class="img-responsive" src="{{ asset('img/logo/skillema_dark.png') }}" >
            </a>
        </div>
        <div class="nav navbar navbar-right rtl">
            <a class="btn btn-violet" style="margin-top: 10px" data-toggle="modal" data-target="#myModal" >دریافت آخرین اخبار Skillema</a>
        </div>
        <div class="nav navbar navbar-right rtl">
            <div class="links">
                {{--<a class="text-muted" href="#">چرا به Skillema اعتماد کنم ؟</a>--}}
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">عضویت در خبرنامه</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'invitation.register', 'class'=>'form-horizontal', 'id'=>'invitation_form']) !!}
                    <div class="form-group rtl">
                        <label for="first_name" class="col-sm-3 control-label pull-right">نام : </label>
                        <div class="col-sm-6 pull-right">
                            <input type="email" name="first_name" class="form-control pull-right" id="first_name" placeholder="نام">
                        </div>
                    </div>

                    <div class="form-group rtl">
                        <label for="last_name" class="col-sm-3 control-label pull-right">نام خانوادگی : </label>
                        <div class="col-sm-6 pull-right">
                            <input type="email" name="last_name" class="form-control pull-right" id="last_name" placeholder="نام خانوادگی">
                        </div>
                    </div>

                    <div class="form-group rtl">
                        <label for="email" class="col-sm-3 control-label pull-right">آدرس ایمیل : </label>
                        <div class="col-sm-6 pull-right">
                            <input type="email" name="email" class="form-control pull-right" id="email" placeholder="آدرس ایمیل">
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                <button type="button" id="invitation_register" class="btn btn-violet">عضویت در خبرنامه</button>
            </div>
        </div>
    </div>
</div>

<main>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    @include('flash::message')

    <section id="wellcome" class="hero">
        <div class="text-center">
            <div class="big-logo">
                <img src="{{ asset('img/logo/skillema.png') }}">
            </div>
            <h1 class="site-name" >شبکه اجتماعی مهارت های ایرانی</h1>
            <div class="timer-container">
                <div class="timer">
                    <ul class="countdown">
                        <li><span class="days">00</span>
                            <p class="days_ref">روز</p>
                        </li>
                        <li class="seperator">.</li>
                        <li><span class="hours">00</span>
                            <p class="hours_ref">ساعت</p>
                        </li>
                        <li class="seperator">:</li>
                        <li><span class="minutes">00</span>
                            <p class="minutes_ref">ددقیقه</p>
                        </li>
                        <li class="seperator">:</li>
                        <li><span class="seconds">00</span>
                            <p class="seconds_ref">ثانیه</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="newsletter-container clearfix">
                {!! Form::open(['route'=>'invitation.register']) !!}
                    <input type="email" name="email" class="form-control" placeholder="آدرس ایمیل...">
                <button type="submit" class="btn btn-violet">عضویت در خبرنامه</button>
                {!! Form::close() !!}
            </div>
        </div>
    </section>

    <section class="description clearfix" id="social_network">
        <div class="container">
            <div class="in-info pull-right right">
                <h1>یک شبکه اجتماعی هستیم</h1>
                <a data-toggle="modal" data-target="#myModal" class="btn btn-violet btn-lg">بیشتر بدانید</a>
            </div>
            <div class="info">
                <div class="text-center">
                    <i class="fa fa-users fa-3x"></i>
                </div>
                <p>
                    اگر می خواهی با مهارت هات همه رو انگشت به دهن کنی . اگر مشکل خیلی ها که دنبال مهارت شما هستند اینه که نمی شناسنت. یا اگر مثل خیلی ها معتقدی برای رشد و شکوفا شدن مهارت هات نیاز به فضایی با ارتباطات گسترده داری نه کنج عزلت.
                </p>
                <p>پس همین حالا شروع کن . چون ما به معنای واقعی</p>
                <h3 class="text-center" >یک شبکه اجتماعی هستیم</h3>
                <p>ما یک شبکه اجتماعی قدرتمند هستیم برای یافتن و ایجاد ارتباط با دوستانی که قدر مهارت شما را می دانند، دوست دارند به شما یاد بدهند و دوست دارند از شما یاد بگیرند.</p>
            </div>
        </div>
    </section>

    <section class="description clearfix" id="skill">
        <div class="container">
            <div class="in-info pull-left left">
                <h1>بانک اطلاعاتی از مهارت های ارزشمند</h1>
                <a data-toggle="modal" data-target="#myModal" class="btn btn-violet btn-lg">بیشتر بدانید</a>
            </div>
            <div class="info pull-right">
                <div class="text-center">
                    <i class="fa fa-trophy fa-3x"></i>
                </div>
                <p>اگر مثل خیلی ها مسأله ات اینه که دقیقاً همون لحظه و همون جایی که می خواهی و نیاز داری کسی رو نمی شناسی که مشکلت رو حل کنه  یا مثل خیلی های دیگه کلی گزینه که نمی دونی کدومش بهتره کلافت کرده.</p>
                <p>پس همین حالا شروع کن . چون ما افتخار می کنیم خود را جامعه وسیعی از صاحبان مهارت و </p>
                <h4 class="text-center" >بانک اطلاعاتی از مهارت های ارزش گذاری شده</h4>
                <p>بدانیم . ضمناً این را هم در نظر بگیر که ممکنه یه زمانی و یه جایی بتونی مشکل کسی رو حل کنی.</p>
            </div>
        </div>
    </section>

    <section class="how-to orange">
        <h1>چطور مهارت هام را توسعه بدم؟</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/groups.png') }}">
                        </div>
                        <h4>تو گروه های تخصصی فعالیت کن</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/learn.png') }}">
                        </div>
                        <h4>در دوره های مهارت آموزی مجموعه شرکت کن</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/handshake.png') }}">
                        </div>
                        <h4>با کاربران ماهر در مهارتت در ارتباط باش</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/statistics.png') }}">
                        </div>
                        <h4>وضعیتتو با سیستم ارزیابی ما کنترل کن</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="description" id="shop">
        <div class="container">
            <div class="in-info pull-right right">
                <h1>فروشگاه شخصی حرفه ایم</h1>
                <a data-toggle="modal" data-target="#myModal" class="btn btn-violet btn-lg">بیشتر بدانید</a>
            </div>
            <div class="info">
                <div class="text-center">
                    <i class="fa fa-shopping-cart fa-3x"></i>
                </div>
                <p>اگر ماحصل و نتیجه هنر و مهارتت انقدری شده که فکر می کنی می تونی یک فروشگاه بزرگ بزنی. یا اینکه مجبوری نتیجه کارتو با قیمت کمی بسپاری به یک سری آدم سودجو که نه شناختی از هنر و مهارتت دارند و نه براش ارزشی قائلند.
                    پس همین حالا شروع کن . چون اینجا می تونی صاحب یک
                </p>
                <h4 class="text-center" >فروشگاه شخصی حرفه ای</h4>
                <p> باشی و درآمد کسب کنی. یعنی خودت باشی و کلی مشتری که به فروشگاهت سر می زنند. چون ما تو معرفی شما به مشتری هات کمک ات می کنیم. البته امکانات حرفه ای فروشگاه را هم بهتر خودت تجربه کنی. </p>
            </div>
        </div>
    </section>

    <section class="description clearfix" id="intro">
        <div class="container">
            <div class="in-info pull-left left">
                <h1>راه های متعددی برای معرفی بهتر شما</h1>
                <a data-toggle="modal" data-target="#myModal" class="btn btn-violet btn-lg">بیشتر بدانید</a>
            </div>
            <div class="info pull-right">
                <div class="text-center">
                    <i class="fa fa-bullhorn fa-3x"></i>
                </div>
                <p>شاید جزء اون دسته از آدم هایی باشی که با وجود توانمندی و مهارت خیلی زیادت هیچ وقت نتونستی خودت را بدرستی معرفی کنی واسه همین دیگران کمتر با توانمندی هات آشنایی دارند. این روز ها آدم های توانمندی که نمی توانند خودشان را معرفی کنند زیاد می بینیم و از طرفی آدم های ضعیفی که چقدر خوب خودشان را پرزنت می کنند اما موفق واقعی اونهایی هستند که علاوه داشتن توانمندی بالاخره تونستند راه ارائه و معرفی اون را کشف کنند. اگه میخواهی موفق واقعی باشی پس همین حالا شروع کن . چون در اینجا ما   </p>
                <h4 class="text-center" >راه های متعددی برای معرفی بهتر شما</h4>
                <p>برنامه ریزی کردیم و پیش رویت می گذاریم.</p>
            </div>
        </div>
    </section>

    <section class="description" id="ability">
        <div class="container">
            <div class="in-info pull-right right">
                <h1>راه های متعددی برای توسعه مهارت های شما</h1>
                <a href="#" class="btn btn-violet btn-lg">بیشتر بدانید</a>
            </div>
            <div class="info">
                <div class="text-center">
                    <i class="fa fa-suitcase fa-3x"></i>
                </div>
                <p>برای ما مهم نیست که چقدر سواد داری، مهم نیست مدرک تحصیلی ات چیه، دیپلم، فوق دیپلم، لیسانس یا دکتری، مهم نیست کدوم دانشگاه درس خوندی ام آی تی، استفورد، شریف، تهران یا یک دانشگاه کوچک تو یک شهر کوچک.اینجا یک چیز حرف اول و آخر رو میزنه و اون اینه که شما با همه اسم و رسمت چی بلدی؟ پس اگر از مدرک و مدرک گرایی خسته شدی و دنبال مهارت واقعی می گردی همین حالا شروع کن. چون ما</p>
                <h4 class="text-center" >راه های متعددی برای توسعه مهارت های شما</h4>
                <p>برنامه ریزی کردیم.</p>
            </div>
        </div>
    </section>

    <section class="how-to blue container-fluid">
        <h1>چطور درآمد کسب کنم؟</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/bullhorn.png') }}">
                        </div>
                        <h4>از ابزارهای بازار یابی مجموعه استفاده کن</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/light_bulb.png') }}">
                        </div>
                        <h4>مهارت ها تو به مشتری هات ارائه کن</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/shop.png') }}">
                        </div>
                        <h4>فروشگاه شخصی تو بساز و محصولات تو ارائه بده</h4>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <div class="step">
                        <div class="icon">
                            <img src="{{ asset('../img/invitation/icons/link.png') }}">
                        </div>
                        <h4>لینک سایر اعضای شبکه رو معرفی کن</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="long_way" class="hero how-to">
        <div class="text-center">
            <h1>یک سفر هزار مایلی با اولین قدم آغاز می شود</h1>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 pull-right">
                        <div class="step">
                            <div class="icon">
                                <img src="{{ asset('../img/invitation/icons/check_status.png') }}">
                            </div>
                            <h4>ثبت نام کن و پروفایل تو ایجاد کن</h4>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <div class="step">
                            <div class="icon">
                                <img src="{{ asset('../img/invitation/icons/light_bulb.png') }}">
                            </div>
                            <h4>مهارت ها تو ثبت کن و در گروه ها عضو شو</h4>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <div class="step">
                            <div class="icon">
                                <img src="{{ asset('../img/invitation/icons/location.png') }}">
                            </div>
                            <h4>دوستان و مشتری ها تو شناسایی کن</h4>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <div class="step">
                            <div class="icon">
                                <img src="{{ asset('../img/invitation/icons/share.png') }}">
                            </div>
                            <h4>مهارت ها تو با آنها به اشتراک بذار</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="clearfix">
    <div class="text-center">
        <h1>با ما در ارتباط باشید</h1>
        <ul class="icons-list">
            <li class="icons-list-item">
                <a href="#" class="social"><i class="fa fa-facebook-f fa-2x" style="padding: 0 3px" ></i></a>
            </li>
            <li class="icons-list-item">
                <a href="#" class="social"><i class="fa fa-twitter fa-2x" ></i></a>
            </li>
            <li class="icons-list-item">
                <a href="#" class="social"><i class="fa fa-linkedin fa-2x" ></i></a>
            </li>
            <li class="icons-list-item">
                <a href="#" class="social"><i class="fa fa-instagram fa-2x" ></i></a>
            </li>
            <li class="icons-list-item">
                <a href="#" class="social"><i class="fa fa-google fa-2x" ></i></a>
            </li>
        </ul>
    </div>
</footer>


<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.downCount.js') }}"></script>
<script class="source" type="text/javascript">
    $('.countdown').downCount({
            date: '01/19/2016 12:00:00',
            offset: +10
    });

    $(document).ready(function(){
        $("#invitation_register").click(function(){
            $("#invitation_form").submit();
        })
    })

</script>
</body>
</html>