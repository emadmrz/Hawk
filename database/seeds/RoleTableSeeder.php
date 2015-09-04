<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[];
        $roles[]=array(
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'The administrator of the website',
            'level' => 1,
        );
        $roles[]=array(
            'name' => 'User',
            'slug' => 'user',
            'description' => 'The user who register in the website and he/she is not legal',
            'level' => 1,
        );
        $roles[]=array(
            'name' => 'Legal',
            'slug' => 'legal',
            'description' => 'The user who register and he/she is legal',
            'level' => 1,
        );
        foreach($roles as $role){
            Role::create($role);
        }
    }
}
