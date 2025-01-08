<?php

use Illuminate\Database\Seeder;

class BetOutcomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outcomes = [
            [
                'outcome' => '1 (home)',
            ],

            [
                'outcome' => '1X (home or draw)',
            ],

            [
                'outcome' => 'X (draw)',
            ],

            [
                'outcome' => '2 (away)',
            ],

            [
                'outcome' => 'X2 (draw or away)',
            ],

            [
                'outcome' => '12 (home or away)',
            ],

            [
                'outcome' => 'H1 (first half - home)',
            ],

            [
                'outcome' => 'HX (first half - draw)',
            ],

            [
                'outcome' => 'H2 (first half - away)',
            ],

            [
                'outcome' => '2H1 (second half - home)',
            ],

            [
                'outcome' => '2HX (second half - draw)',
            ],

            [
                'outcome' => '2H2 (second half - away)',
            ],

            [
                'outcome' => 'over (1.5)',
            ],

            [
                'outcome' => 'over (2.5)',
            ],

            [
                'outcome' => 'over (3.5)',
            ],

            [
                'outcome' => 'over (4.5)',
            ],

            [
                'outcome' => 'over (5.5)',
            ],

            [
                'outcome' => 'over (6.5)',
            ],

            [
                'outcome' => 'under (1.5)',
            ],

            [
                'outcome' => 'under (2.5)',
            ],

            [
                'outcome' => 'under (3.5)',
            ],

            [
                'outcome' => 'under (4.5)',
            ],

            [
                'outcome' => 'under (5.5)',
            ],

            [
                'outcome' => 'under (6.5)',
            ],

            [
                'outcome' => 'both teams score',
            ],

            [
                'outcome' => 'correct score',
            ],
        ];

        App\BetOutcome::insert($outcomes);
    }
}
