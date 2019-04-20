<?php

use Illuminate\Database\Seeder;

class UserTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $admin->attachRole('admin');
    }
}
