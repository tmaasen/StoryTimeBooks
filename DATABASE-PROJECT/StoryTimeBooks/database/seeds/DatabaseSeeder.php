<?php

use App\Book;
use App\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserAddressTableSeeder::class);
        $this->call(UserCreditCardSeeder::class);
        $this->call(Product::class);
    }
}
