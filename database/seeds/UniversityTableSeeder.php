<?php

use App\University;
use Illuminate\Database\Seeder;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::create(['name'=>'شهید بهشتی', 'logo'=>'Shahid_Beheshti_University_logo.png']);
    }
}
