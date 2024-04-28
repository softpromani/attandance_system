<?php

namespace Database\Seeders;

use App\Models\FeeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $feeTypes = [
            ['fee_type' => 'Tution fee', 'created_at' => $now, 'updated_at' => $now],
            ['fee_type' => 'Exam fee', 'created_at' => $now, 'updated_at' => $now],
            ['fee_type' => 'Vehicle fee', 'created_at' => $now, 'updated_at' => $now],
        ];

        // Insert fee types into the database
        FeeType::insert($feeTypes);
    }
}
