<?php

/**
 * Created by Emad Mirzaie on 13/10/2015.
 * This Config file manage the Storage add-on
 * users can buy storage add-on and increase their capacity
 */

return [
    'title'=>'پرسش نامه',
    'slug'=>'پرسش نامه از دوستان',
    'banner'=>'stock-vector-voting-elections-results-hands-raised-up-infographics-elements-vector-268995362.jpg',
    'base_price'=>15000,
    'images'=>[
        'search-engine-optimization-concept-vector_23-2147497530.jpg',
        'search-engine-optimization-concept-vector_23-2147497530.jpg',
        'search-engine-optimization-concept-vector_23-2147497530.jpg',
        'search-engine-optimization-concept-vector_23-2147497530.jpg',
    ],
    'description'=>'PHP مخفف PHypertext Preprocessor یک زبان قدرتمند ( Cross-Platform , Html embeded ) برای ساخت وب سایت های پویا و داینامیک است . یک زبان سمت سرور که اسکریپت های آن بر روی سرور اجرا می شود . با استفاده از زبان php ، شما می توانید سایت ها و پورتال های بزرگ سازمانی را با قدرت طراحی و برنامه نویسی کنید . php در نسخه های مختلفی به بازار عرضه شد که در حال حاضر نسخه ۵ آن توسط توسعه دهندگان php به کاربران و برنامه نویسان ارائه شده است . با آمدن php 5 تحول جدیدی در php ایجاد شد به صورتی که Microsoft سازنده زبان Asp بار دیگر از رقیب خود یعنی php عقب افتاد. سمت سرور یا server side بدین معنی است که دستورات بر روی سرور اجرا می شود و کاربر نمی تواند در آن دخیل باشد . یک سرویس دهنده در حقیقت یک کامپیوتر مخصوص می باشد که صفحات وب در آنجا نگهداری می شوند و از آنجا به مرورگر وب کاربران منتقل می شوند.',
    'discount'=> 0.2,
    'attributes'=>[
        1 => [
            'name'=>'count',// Important value
            'title'=>'تعداد ',
            'values'=>[
                1 => ['name'=>'100 پرسشنامه','add_price'=>2000,'count'=>100],
                2 => ['name'=>'300 پرسشنامه','add_price'=>4000,'count'=>300],
                3 => ['name'=>'500 پرسشنامه','add_price'=>6000,'count'=>600],
            ],
        ]
    ]


];