<?php

namespace Database\Seeders;

use App\Models\Year;
use App\Models\YearModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class yearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentYear = Carbon::now()->year;
        $years = ['2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029'];

        // Insert the current year
        foreach ($years as $year) {
            Year::create([
                'year' => $year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


    }
}
}

