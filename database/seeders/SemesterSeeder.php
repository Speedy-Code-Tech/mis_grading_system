<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $semesters = [
            [
                'name' => '1st Semester',
                'start_year' => 2024,
                'end_year' => 2025,
                'status' => True
            ],
            [
                'name' => '2nd Semester',
                'start_year' => 2024,
                'end_year' => 2025,
                'status' => False
            ]
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }
    }
}
