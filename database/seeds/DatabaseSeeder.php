<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamTableDataSeeder::class);
        $this->call(MatchTableDataSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableDataSeeder::class);
        $this->call(PlayerTableDataSeeder::class);
    }
}
