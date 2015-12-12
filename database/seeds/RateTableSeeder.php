<?php

use App\Rate;
use Illuminate\Database\Seeder;

class RateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::create([
            'parentable_id'=> '',
            'parentable_type'=> '',
            'rate'=>1
        ]);
    }
}
