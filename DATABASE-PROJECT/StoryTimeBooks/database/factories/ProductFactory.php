<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->jobTitle,
        'author' => $faker->name($gender = null),
        'publisher_id' => $faker->numberBetween($min = 1, $max = 5),
        'copyright_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'isbn_13' => $faker->isbn13,
        'retail_price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 2),
        'company_cost' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 2),
        'quantity_on_hand' => $faker->randomDigitNotNull,
    ];
});
