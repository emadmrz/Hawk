<?php

use App\AttributeGroup;
use Illuminate\Database\Seeder;

class AttributeGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [];
        $attributes[] = ['name'=>'رنگ', 'type'=>'color'];
        $attributes[] = ['name'=>'سایز', 'type'=>'text'];
        foreach($attributes as $attribute){
            AttributeGroup::create($attribute);
        }
    }
}
