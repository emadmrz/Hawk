<?php

use App\Advantage;
use Illuminate\Database\Seeder;

class AdvantageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $advantages = [];
        $advantages[] = ['title'=>'ارسال سریع کالا', 'logo'=>'icon-checkout', 'description'=>''];
        $advantages[] = ['title'=>'تضمین اصالت', 'logo'=>'icon-shippment', 'description'=>''];
        $advantages[] = ['title'=>'گارانتی سلامت کالا', 'logo'=>'icon-calendar-1', 'description'=>''];
        $advantages[] = ['title'=>'ضمانت بازگشت', 'logo'=>'icon-refresh-1', 'description'=>''];
        $advantages[] = ['title'=>'بسته بندی شیک', 'logo'=>'icon-gift', 'description'=>''];
        $advantages[] = ['title'=>'پرداخت در محل', 'logo'=>'icon-wallet', 'description'=>''];
        foreach($advantages as $advantage){
            Advantage::create($advantage);
        }
    }
}
