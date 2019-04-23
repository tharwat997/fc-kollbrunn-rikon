<?php

use Illuminate\Database\Seeder;

class BoardMemberTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boardMember = new \App\BoardMember([
            'name' => 'Silvio',
            'title' => 'President',
            'email' => 'silvio@gmail.com',
            'mobile_number' => '1234567890',
            'image' => asset('images/player_placeholder.jpg'),
        ]);
        $boardMember->save();
        $boardMember->addMedia('resources/images/placeholder.jpg')
            ->preservingOriginal()
            ->withResponsiveImages()
            ->toMediaCollection('boardMembersImages');
    }
}
