<?php

namespace Database\Seeders;

use App\Models\Quarter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Quarter::insert([
            [
                'name' => '1st Quarter',
                'semester_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2nd Quarter',
                'semester_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '3rd Quarter',
                'semester_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '4th Quarter',
                'semester_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
