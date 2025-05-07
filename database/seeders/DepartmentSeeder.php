<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            [
                'course_code' => 'ABM',
                'full_name' => 'Accountancy, Business, and Management',
                'description' => 'Focused on business principles, accounting, and management studies.'
            ],
            [
                'course_code' => 'STEM',
                'full_name' => 'Science, Technology, Engineering, and Mathematics',
                'description' => 'Concentrates on scientific, technological, engineering, and mathematical concepts.'
            ],
            [
                'course_code' => 'HUMSS',
                'full_name' => 'Humanities and Social Sciences',
                'description' => 'Covers studies in humanities, social sciences, and public administration.'
            ],
            [
                'course_code' => 'ICT',
                'full_name' => 'Information and Communications Technology',
                'description' => 'Focuses on computer studies, programming, and IT essentials.'
            ],
            [
                'course_code' => 'TVL',
                'full_name' => 'Technical-Vocational-Livelihood',
                'description' => 'Hands-on courses in various vocational and livelihood skills.'
            ]
        ];
        
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
