<?php

use App\Province;
use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            ['name' => 'Test Province', 'children' => [
                ['name' => 'Test City',],
            ]],
        ];

        Province::buildTree($provinces);
    }
}
