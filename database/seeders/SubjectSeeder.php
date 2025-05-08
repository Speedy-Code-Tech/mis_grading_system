<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = [
            ['name' => 'General Mathematics', 'level' => 11],
            ['name' => 'Physical Science', 'level' => 11],
            ['name' => 'English for Academic Purposes', 'level' => 11],
            ['name' => 'Programming 1', 'level' => 11],
            ['name' => 'Entrepreneurship', 'level' => 12],
            ['name' => 'Earth and Life Science', 'level' => 12],
            ['name' => '21st Century Literature', 'level' => 12],
            ['name' => 'Networking and Communications', 'level' => 12],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
