<?php

use App\Character;
use Illuminate\Database\Seeder;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::create([
            'name' => 'Degro',
            'race' => 'Zwerg',
            'profession' => 'Warrior',
            'gender' => '1',
            'size' => '135',
            'wight' => '61',
            'age' => '55',
            'MU' => '14',
            'KL' => '13',
            'IN' => '13',
            'CH' => '8',
            'FF' => '13',
            'GE' => '13',
            'KO' => '14',
            'KK' => '14',
            'ap_total' => '1147',
            'ap_spend' => '1119',

        ]);
        Character::create([
            'name' => 'Leonardo Descartes',
            'race' => 'Mensch',
            'profession' => 'Grau Magier',
            'gender' => '1',
            'size' => '195',
            'wight' => '85',
            'age' => '19',
            'MU' => '13',
            'KL' => '14',
            'IN' => '14',
            'CH' => '13',
            'FF' => '12',
            'GE' => '10',
            'KO' => '12',
            'KK' => '12',
            'ap_total' => '1100',
            'ap_spend' => '1100',

        ]);
    }
}