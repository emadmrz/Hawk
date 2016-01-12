<?php

use Illuminate\Database\Seeder;

class RecruitmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recruitments=[];
        $recruitments[]=array(
            'content' => 'چرا ما باید شما را استخدام کنیم ؟'
        );
        $recruitments[]=array(
            'content' => 'پنج کلمه بنویسید که کاراکتر شما را توصیف می نماید ؟'
        );
        $recruitments[]=array(
            'content' => 'علت اصلی انتخاب مجموعه اصلی ما برای آینده شغلیتان چیست ؟'
        );
        $recruitments[]=array(
            'content' => 'مهمترین ویژگی های اخلاقی شما چیست ؟'
        );
        $recruitments[]=array(
            'content' => 'اگر با تصمیم مدیرتان مخالف هستید چگونه آنرا ابراز میکنید ؟'
        );
        foreach($recruitments as $recruitment){
            \App\RecruitmentQuestionnaire::create($recruitment);
        }
    }
}
