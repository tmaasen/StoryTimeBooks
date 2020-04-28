<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserCreditCard;
use App\User;
use Faker\Generator as Faker;

$factory->define(UserCreditCard::class, function (Faker $faker) {
    $users = User::all()->pluck('id')->toArray();

    for ($i = 0; $i < 10; $i++) {
        $user = $faker->randomElement($users);
    }
    
    return [
    'user_id' => $faker->randomelement($users),
    'card_type' => $faker->creditCardType,
    'card_number' => $faker->creditCardNumber,
    'exp_month' => $faker->randomDigit,
    'exp_year' =>$faker->numberBetween($min = 20, $max = 22)
    ];
});
