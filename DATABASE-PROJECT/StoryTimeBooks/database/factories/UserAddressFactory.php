<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\UserAddress;
use App\User;
use App\Model;
use Faker\Generator as Faker;

$factory->define(UserAddress::class, function (Faker $faker) {
    $users = User::all()->pluck('id')->toArray();

    for ($i = 0; $i < 10; $i++) {
        $user_id = $faker->randomElement($users);
    }
    return [
        'user_id' => $faker->randomelement($users),
        'address_line_1' => $faker->streetAddress,
        'suite_no' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state_id' => $faker->numberBetween($min = 1, $max = 50),
        'zipcode' => $faker->postcode,
        'home_phone' => $faker->tollFreePhoneNumber,
        'work_phone' => $faker->tollFreePhoneNumber,
        'rowguid' => $faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}')

    ];
});
