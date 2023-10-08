<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CommonQuestionSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(HomePageContentSeeder::class);
        $this->call(OfferPageContentSeeder::class);
    }
}
