<?php

use Illuminate\Database\Seeder;

class SubscriptionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptionTypes = [
            [
                'subscription_type' => 'GOLD',
                'price'             => 200,
                'no_of_days'        => 7,
            ],

            [
                'subscription_type' => 'PLATINUM',
                'price'             => 300,
                'no_of_days'        => 14,
            ],

            [
                'subscription_type' => 'DIAMOND',
                'price'             => 500,
                'no_of_days'        => 30,
            ],
        ];
        
        App\SubscriptionType::insert($subscriptionTypes);
    }
}
