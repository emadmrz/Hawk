<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>به skillema خوش آمدید</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/invitation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body>

<section id="header" class="container-fluid text-white">
    <div class="container">
        <div class="row clearfix">
            <div class="scroll col-sm-6 column pull-right text-right">
                {{--<h1 class="text-right">--}}
                    {{--<i id="logo" class="fa fa-paper-plane-o"></i>--}}
                {{--</h1>--}}
                <h1 class="main_title text-right rtl">ما به سختی مشغول کار بر روی شبکه اجتماعی مهارت ایرانیان هستیم.</h1>
                <p class="text-right lead rtl">
                    با دریافت دعوتنامه عضویت در skillema در بین اولین نفراتی باشید که از این شبکه اجتماعی نوآورانه با ساختاری متفاوت استفاده می کنند. پیوستن شما به خانواده skillema به ما دلگرمی می دهد.
                </p>
                <div class="text-right">
                    {!! Form::open(['id'=>'invitation_form', 'class'=>'pull-right']) !!}
                    <div class="input-group">
                        <span class="input-group-btn"><button class="btn btn-lead btn-lg" type="button"> دریافت <i style="margin-left: 5px" class="fa fa-envelope-o"></i></button></span>
                        <input type="text" class="form-control invitation-email input-lg" placeholder="آدرس ایمیل ...">
                    </div><!-- /input-group -->
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-sm-6 column pull-right" style="padding: 0 40px">
                <img class="img-responsive" src="{{ asset('img/logo/skillema_white.png') }}" alt="Slide Two" draggable="false">
            </div>
        </div>
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
    </div><!-- /container  -->
</section>

<main>
    <div class="container">

        <div class="row">
            <section id="part1" class="overview clearfix rtl">
                <div class="col-sm-4 wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s">
                    <img src="{{ asset('img/invitation/social.png') }}">
                </div>
                <div class="col-sm-8 wow slideInRight" data-wow-duration="2s" data-wow-delay="0s">
                    <p class="text">
                        اگر می خواهی با ماهرهات همه رو انگشت به دهن کنی . اگر مشکل خیلی ها که دنبال مهارت شما هستند اینه که نمی شناسنت. یا اگر مثل خیلی ها معتقدی برای رشد و شکوفا شدن مهارت هات نیاز به فضایی با ارتباطات گسترده داری نه کنج عزلت.
                        پس همین حالا شروع کن . چون ما به معنای واقعی
                    </p>
                    <h2 class="text-violet text-center"> یک شبکه اجتماعی هستیم </h2>
                    <p class="text">
                        ما یک شبکه اجتماعی قدرتمند هستیم برای یافتن و ایجاد ارتباط با دوستانی که قدر مهارت شما را می دانند، دوست دارند به شما یاد بدهند و دوست دارند از شما یاد بگیرند.
                    </p>
                </div>
            </section>
        </div>

        <div class="row">
            <section id="part1" class="overview clearfix rtl">
                <div class="col-sm-4 pull-right wow slideInRight" data-wow-duration="1s" data-wow-delay="0s">
                    <img src="{{ asset('img/invitation/skill.png') }}">
                </div>
                <div class="col-sm-8 pull-right wow slideInLeft" data-wow-duration="2s" data-wow-delay="0s">
                    <p class="text">
                        اگر مثل خیلی ها مسأله ات اینه که دقیقاً همون لحظه و همون جایی که می خواهی و نیاز داری کسی رو نمی شناسی که مشکلت رو حل کنه  یا مثل خیلی های دیگه کلی گزینه که نمی دونی کدومش بهتره کلافت کرده.
                        پس همین حالا شروع کن . چون ما افتخار می کنیم خود را جامعه وسیعی از صاحبان مهارت و
                    </p>
                    <h2 class="text-violet text-center"> بانک اطلاعاتی از مهارت های ارزش گذاری شده </h2>
                    <p class="text">
                        بدانیم . ضمناً این را هم در نظر بگیر که ممکنه یه زمانی و یه جایی بتونی مشکل کسی رو حل کنی.
                    </p>
                </div>
            </section>
        </div>

        <div class="row">
            <section id="part1" class="overview clearfix rtl">
                <div class="col-sm-4 wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s">
                    <img src="{{ asset('img/invitation/shop-icon.jpg') }}">
                </div>
                <div class="col-sm-8 wow slideInRight" data-wow-duration="2s" data-wow-delay="0s">
                    <p class="text">
                        اگر ماحصل و نتیجه هنر و مهارتت انقدری شده که فکر می کنی می تونی یک فروشگاه بزرگ بزنی. یا اینکه مجبوری نتیجه کارتو با قیمت کمی بسپاری به یک سری آدم سودجو که نه شناختی از هنر و مهارتت دارند و نه براش ارزشی قائلند.
                        پس همین حالا شروع کن . چون اینجا می تونی صاحب یک
                    </p>
                    <h2 class="text-violet text-center"> فروشگاه شخصی حرفه ای </h2>
                    <p class="text">
                        باشی و درآمد کسب کنی. یعنی خودت باشی و کلی مشتری که به فروشگاهت سر می زنند. چون ما تو معرفی شما به مشتری هات کمک ات می کنیم تا روزه به روز مشتری های بیشتر داشته باشی. البته امکانات حرفه ای فروشگاه را هم بهتری خودت تجربه کنی.
                    </p>
                </div>
            </section>
        </div>

        <div class="row">
            <section id="part1" class="overview clearfix rtl">
                <div class="col-sm-4 pull-right wow slideInRight" data-wow-duration="1s" data-wow-delay="0s">
                    <img src="{{ asset('img/invitation/hopeforchildren.png') }}">
                </div>
                <div class="col-sm-8 pull-right wow slideInLeft" data-wow-duration="2s" data-wow-delay="0s">
                    <p class="text">
                        شاید جزء اون دسته از آدم هایی باشی که با وجود توانمندی و مهارت خیلی زیادت هیچ وقت نتونستی خودت را بدرستی معرفی کنی واسه همین دیگران کمتر با توانمندی هات آشنایی دارند. اما جالبه که بدونی این مشکل خیلی از ما است. یعنی این روز ها آدم های توانمندی که نمی توانند خودشان را معرفی کنند زیاد می بینیم و از طرفی آدم های ضعیفی که چقدر خوب خودشان را پرزنت می کنند. شاید هم بین اندازه توانمندی و قدرت معرفی اون رابطه عکس وجود داره . اما مطمئناً آدمهای ضعیفی که خوب پرزنت می کنند موفقیت دو سه روزه ای دارند چون نهایتاً لو میرن و موفق واقعی اونهایی هستند که علاوه داشتن توانمندی بالاخره تونستند راه ارائه و معرفی اون را کشف کنند. اگه میخواهی موفق واقعی باشی پس همین حالا شروع کن . چون در اینجا ما                       </p>
                    <h2 class="text-violet"> راه های متعددی برای معرفی بهتر شما </h2>
                    <p class="text" >برنامه ریزی کردیم و پیش رویت می گذاریم.</p>
                </div>
            </section>
        </div>

        <div class="row">
            <section id="part1" class="overview clearfix rtl">
                <div class="col-sm-4 wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s">
                    <img src="{{ asset('img/invitation/hopeforchildren.png') }}">
                </div>
                <div class="col-sm-8 wow slideInRight" data-wow-duration="2s" data-wow-delay="0s">
                    <p class="text">
                        برای ما مهم نیست که چقدر سواد داری، مهم نیست مدرک تحصیلی ات چیه، دیپلم، فوق دیپلم، لیسانس یا دکتری، مهم نیست کدوم دانشگاه درس خوندی ام آی تی، استفورد، شریف، تهران یا یک دانشگاه کوچک تو یک شهر کوچک . پس اگر دنبال این القاب هستی احتمالاً اینجا جای مناسب برای شما نیست. اینجا یک چیز حرف اول و آخر رو میزنه و اون اینه که شما با همه اسم و رسمت چی بلدی؟ پس اگر از مدرک و مدرک گرایی خسته شدی و دنبال مهارت واقعی می گردی همین حالا شروع کن. چون ما
                    </p>
                    <h2 class="text-violet text-center">راه های متعددی برای توسعه مهارت های شما </h2>
                    <p class="text">
                        برنامه ریزی کردیم.                    </p>
                </div>
            </section>
        </div>


    </div>
</main>

<footer>
    <h4 class="text-center rtl">
        در حالی که ما مشغول تکمیل skillema  هستیم، شما امکانات این شبکه را بررسی کنید و با ثبت دعوتنامه، به ما بپیوندید.
    </h4>
</footer>


<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.downCount.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script class="source" type="text/javascript">
    $('.countdown').downCount({
            date: '12/30/2015 12:00:00',
            offset: +10
    });

    WOW = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       150,          // default
        mobile:       true,       // default
        live:         true        // default
    });
    WOW.init();
</script>
</body>
</html>