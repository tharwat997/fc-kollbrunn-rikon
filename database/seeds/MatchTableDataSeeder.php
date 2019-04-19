<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MatchTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $sampleMatch = \App\Match::create([
            'match_type' => 'League',
            'type_name' => 'Testing League',
            'teamA_name' => 'FC-Kollbrunn-Rikon',
            'teamA_score' => 0,
            'teamB_name' => 'Testing Team',
            'teamB_score' => 0,
            'start_date_time' => $dateNow,
            'reporter_id' => 1 ,
        ]);

        $sampleMatch = \App\Match::create([
            'match_type' => 'League',
            'type_name' => 'Testing League',
            'teamA_name' => 'FC-Kollbrunn-Rikon',
            'teamA_score' => 0,
            'teamB_name' => 'Testing Team',
            'teamB_score' => 0,
            'start_date_time' => $dateNow,
            'reporter_id' => 1 ,
        ]);
        $sampleMatch = \App\Match::create([
            'match_type' => 'League',
            'type_name' => 'Testing League',
            'teamA_name' => 'FC-Kollbrunn-Rikon',
            'teamA_score' => 0,
            'teamB_name' => 'Testing Team',
            'teamB_score' => 0,
            'start_date_time' => $dateNow,
            'reporter_id' => 1 ,
        ]);
        $sampleMatch = \App\Match::create([
            'match_type' => 'League',
            'type_name' => 'Testing League',
            'teamA_name' => 'FC-Kollbrunn-Rikon',
            'teamA_score' => 0,
            'teamB_name' => 'Testing Team',
            'teamB_score' => 0,
            'start_date_time' => $dateNow,
            'reporter_id' => 1 ,
        ]);
        $sampleMatch = \App\Match::create([
            'match_type' => 'League',
            'type_name' => 'Testing League',
            'teamA_name' => 'FC-Kollbrunn-Rikon',
            'teamA_score' => 0,
            'teamB_name' => 'Testing Team',
            'teamB_score' => 0,
            'start_date_time' => $dateNow,
            'reporter_id' => 1 ,
        ]);


    }
}
