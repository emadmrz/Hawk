<?php

use App\CorporationQuestionnaire;
use Illuminate\Database\Seeder;

class CorporationQuestionnaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [];
        $questions[] = ['content'=>'کیفیت و میزان دقت در خدمت ارائه شده را در چه حدی ارزیابی می کنید ؟'];
        $questions[] = ['content'=>'قیمت خدمت ارائه شده را در چه حدی ارزیابی می کنید ؟'];
        $questions[] = ['content'=>'سطح ادب، احترام و خلق و خوی خدمت دهنده را در چه حدی ارزیابی می کنید ؟'];
        $questions[] = ['content'=>'وقت شناسی و پایبند بودن به زمان خدمت دهنده را در چه حدی ارزیابی می کنید ؟'];
        $questions[] = ['content'=>'آیا حاظرید از ایشان مجدداً خدمتی بگیرید ؟'];
        foreach($questions as $question){
            CorporationQuestionnaire::create($question);
        }
    }
}
