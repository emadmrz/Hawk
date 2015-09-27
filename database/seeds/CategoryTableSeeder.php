<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Main Test Cat', 'children' => [
                ['name' => 'Sub Test Cat',],
            ]],
        ];

        Category::buildTree($categories);
    }
}
