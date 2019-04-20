<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Role::create([
           'name' => 'admin',
            'display_name' => 'admin',
            'description' => 'admin'
        ]);

        $reporter = \App\Role::create([
            'name' => 'reporter',
            'display_name' => 'reporter',
            'description' => 'reporter'
        ]);
    }
}
