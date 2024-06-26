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
        $this->call([
            userSeeder::class,
            yearSeeder::class,
            monthSeeder::class,
            LeaveTypeSeeder::class,
            FeeTypeSeeder::class,
            // Add more seeders as needed
        ]);
    }
}
