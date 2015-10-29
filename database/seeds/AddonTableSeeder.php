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
        foreach($addons as $addon){
            Addon::create($addon);
        }
    }
}
