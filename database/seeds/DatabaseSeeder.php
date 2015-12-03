<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(UniversityTableSeeder::class);
        $this->call(AttributeGroupsTableSeeder::class);
        $this->call(AdvantageTableSeeder::class);
        $this->call(AddonTableSeeder::class);
        $this->call(CorporationQuestionnaireTableSeeder::class);

        Model::reguard();
    }
}
