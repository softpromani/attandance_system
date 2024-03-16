<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class monthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        foreach ($months as $index => $month) {
            Month::create([
                'month' => $month,
                'order' => $index + 1, // Assuming you want to store the order of the month as well
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
