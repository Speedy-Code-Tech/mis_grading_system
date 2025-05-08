<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sections = [
            ['name' => 'Section A', 'level_id' => 11, 'department_id' => 1],
            ['name' => 'Section B', 'level_id' => 11, 'department_id' => 1],
            ['name' => 'Section C', 'level_id' => 12, 'department_id' => 2],
            ['name' => 'Section D', 'level_id' => 12, 'department_id' => 2],
        ];

        foreach ($sections as $section) {
            Section::create([
                'uuid' => Str::uuid(),
                'name' => $section['name'],
                'level' => $section['level_id'],
                'department_id' => $section['department_id'],
            ]);
        }
    }
}
