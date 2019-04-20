<?php

use Illuminate\Database\Seeder;

class PlayerTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function playerPosition ($number){
            if ($number === 1){
                return 'goalkeeper';
            } else if ($number <= 4 && $number != 1){
                return 'defender';
            }else if ($number <= 8 && $number > 4){
                return 'midfielder';
            }else if ($number <= 11 && $number > 8){
                return 'attacker';
            }
        }

        $teams = \App\Team::all();
        foreach($teams as $team){
            for ($x = 1; $x <= 11; $x++) {
                $player = new \App\Player([
                    'name' => \Illuminate\Support\Str::random(10),
                    'playerNumber' => rand(1, 100),
                    'playerPosition' => playerPosition($x),
                    'team_id' => $team->id,
                    'age' => rand(5, 45),
                    'total_goals' => 0,
                    'yellow_cards' => 0,
                    'red_cards' => 0,
                    'assists' => 0,
                    'image' => asset('images/player_placeholder.jpg'),
                    'date_joined' => \Illuminate\Support\Facades\Date::today(),
                ]);
                $player->save();

                $player->addMedia('resources/images/placeholder.jpg')
                        ->preservingOriginal()
                        ->withResponsiveImages()
                        ->toMediaCollection('playersImages');

            }
        }
    }
}
