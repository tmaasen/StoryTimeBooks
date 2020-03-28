<?php

use Illuminate\Database\Seeder;

class UserCreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserCreditCard::class, 10)->create();
    }
}
