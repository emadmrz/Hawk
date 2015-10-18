<?php

/**
 * Created by Emad Mirzaie on 13/10/2015.
 * This Config file manage the Storage add-on
 * users can buy storage add-on and increase their capacity
 */

return [
    'title'=>'نظر سنجی',
    'slug'=>'نظر سنجی از دوستان',
    'banner'=>'stock-vector-voting-elections-results-hands-raised-up-infographics-elements-vector-268995362.jpg',
    'base_price'=>2000,
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
            'name'=>'scope',// Important value
            'title'=>'ارسال  برای',
            'values'=>[
                1 => ['name'=>'دوستان','add_price'=>2000,'scope'=>1], // #1 friends
                2 => ['name'=>'کاربران سطح سوم','add_price'=>4000,'scope'=>2], // #2 3th categories
                3 => ['name'=>'کاربران سطح دوم','add_price'=>6000,'scope'=>3], // #3 2th categories
            ],
        ]
    ]


];