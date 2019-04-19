<?php

use Illuminate\Database\Seeder;

class TeamTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstTeam = \App\Team::create([
            'name' => 'First Team',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
        ]);

        $juniorC = \App\Team::create([
            'name' => 'Junior C',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
        ]);

        $juniorD = \App\Team::create([
            'name' => 'Junior D',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
        ]);

        $juniorE = \App\Team::create([
            'name' => 'Junior E',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
        ]);

        $juniorF = \App\Team::create([
            'name' => 'Junior F',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
        ]);

    }
}
