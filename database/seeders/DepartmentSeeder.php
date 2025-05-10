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
                'description' => 'Accountancy, Business, and Management',
            ],
            [
                'course_code' => 'STEM',
                'description' => 'Science, Technology, Engineering, and Mathematics',
            ],
            [
                'course_code' => 'HUMSS',
                'description' => 'Humanities and Social Sciences',
            ],
            [
                'course_code' => 'ICT',
                'description' => 'Information and Communications Technology',
            ],
            [
                'course_code' => 'TVL',
                'description' => 'Technical-Vocational-Livelihood',
            ]
        ];
        
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
