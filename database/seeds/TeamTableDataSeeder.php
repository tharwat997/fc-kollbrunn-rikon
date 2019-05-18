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
            'name' => 'Aktive',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
            'totalDraws' =>0,
        ]);

        $juniorC = \App\Team::create([
            'name' => 'C Junioren',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
            'totalDraws' =>0,
        ]);

        $juniorD = \App\Team::create([
            'name' => 'D Junioren',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
            'totalDraws' =>0,
        ]);

        $juniorE = \App\Team::create([
            'name' => 'E Junioren',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
            'totalDraws' =>0,
        ]);

        $juniorF = \App\Team::create([
            'name' => 'F+G Junioren',
            'totalWins' => 0,
            'totalMatches' => 0,
            'totalLoses' =>0,
            'totalDraws' =>0,
        ]);

    }
}
