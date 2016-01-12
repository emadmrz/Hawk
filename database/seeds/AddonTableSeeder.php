<?php

use App\Addon;
use Illuminate\Database\Seeder;

class AddonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addons =[];
        $addons[] = ['name'=>'storage'];
        $addons[] = ['name'=>'poll'];
        $addons[] = ['name'=>'questionnaire'];
        $addons[] = ['name'=>'shop'];
        $addons[] = ['name'=>'offer'];
        $addons[] = ['name'=>'advertise'];
        $addons[] = ['name'=>'relater'];
        $addons[] = ['name'=>'profit'];
        $addons[] = ['name'=>'showcase'];
        $addons[] = ['name'=>'recruitment'];
        foreach($addons as $addon){
            Addon::create($addon);
        }
    }
}
