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
            // Department 1 - ABM
            ['subject_code' => 'MAT-101', 'name' => 'General Mathematics', 'level' => 11, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'ACC-101', 'name' => 'Fundamentals of Accounting', 'level' => 11, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'BUS-101', 'name' => 'Introduction to Business', 'level' => 11, 'hrs' => 2, 'department_id' => 1],
            ['subject_code' => 'MKT-101', 'name' => 'Principles of Marketing', 'level' => 12, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'ENT-201', 'name' => 'Entrepreneurship', 'level' => 12, 'hrs' => 2, 'department_id' => 1],
            ['subject_code' => 'FIN-201', 'name' => 'Business Finance', 'level' => 12, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'ECON-101', 'name' => 'Economics', 'level' => 11, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'MAN-201', 'name' => 'Management Principles', 'level' => 12, 'hrs' => 3, 'department_id' => 1],
            ['subject_code' => 'COM-101', 'name' => 'Business Communication', 'level' => 11, 'hrs' => 2, 'department_id' => 1],
            ['subject_code' => 'LAW-101', 'name' => 'Business Law', 'level' => 12, 'hrs' => 2, 'department_id' => 1],
        
            // Department 2 - STEM
            ['subject_code' => 'SCI-101', 'name' => 'Physical Science', 'level' => 11, 'hrs' => 2, 'department_id' => 2],
            ['subject_code' => 'MAT-201', 'name' => 'Advanced Algebra', 'level' => 11, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'PHY-101', 'name' => 'Physics 1', 'level' => 12, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'CHEM-101', 'name' => 'Chemistry 1', 'level' => 11, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'BIO-101', 'name' => 'Biology 1', 'level' => 11, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'CALC-101', 'name' => 'Calculus', 'level' => 12, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'SCI-201', 'name' => 'Earth and Life Science', 'level' => 12, 'hrs' => 3, 'department_id' => 2],
            ['subject_code' => 'RES-101', 'name' => 'Scientific Research', 'level' => 12, 'hrs' => 2, 'department_id' => 2],
            ['subject_code' => 'ENV-101', 'name' => 'Environmental Science', 'level' => 11, 'hrs' => 2, 'department_id' => 2],
            ['subject_code' => 'ENG-101', 'name' => 'English for Academic Purposes', 'level' => 11, 'hrs' => 3, 'department_id' => 2],
        
            // Department 3 - HUMSS
            ['subject_code' => 'PHIL-101', 'name' => 'Philosophy of the Human Person', 'level' => 11, 'hrs' => 2, 'department_id' => 3],
            ['subject_code' => 'SOC-101', 'name' => 'Sociology', 'level' => 11, 'hrs' => 3, 'department_id' => 3],
            ['subject_code' => 'PSY-101', 'name' => 'Psychology', 'level' => 12, 'hrs' => 2, 'department_id' => 3],
            ['subject_code' => 'LIT-201', 'name' => '21st Century Literature', 'level' => 12, 'hrs' => 2, 'department_id' => 3],
            ['subject_code' => 'HIST-101', 'name' => 'Philippine History', 'level' => 11, 'hrs' => 3, 'department_id' => 3],
            ['subject_code' => 'POL-101', 'name' => 'Political Science', 'level' => 12, 'hrs' => 2, 'department_id' => 3],
            ['subject_code' => 'ETH-101', 'name' => 'Ethics', 'level' => 11, 'hrs' => 2, 'department_id' => 3],
            ['subject_code' => 'JOUR-101', 'name' => 'Introduction to Journalism', 'level' => 12, 'hrs' => 3, 'department_id' => 3],
            ['subject_code' => 'DRAM-101', 'name' => 'Drama and Theater Arts', 'level' => 12, 'hrs' => 3, 'department_id' => 3],
            ['subject_code' => 'COMM-101', 'name' => 'Oral Communication', 'level' => 11, 'hrs' => 2, 'department_id' => 3],
        
            // Department 4 - ICT
            ['subject_code' => 'PROG-101', 'name' => 'Programming 1', 'level' => 11, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'PROG-201', 'name' => 'Programming 2', 'level' => 12, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'NET-101', 'name' => 'Basic Networking', 'level' => 11, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'NET-201', 'name' => 'Networking and Communications', 'level' => 12, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'WD-101', 'name' => 'Web Development 1', 'level' => 11, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'WD-201', 'name' => 'Web Development 2', 'level' => 12, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'DB-101', 'name' => 'Database Management', 'level' => 11, 'hrs' => 3, 'department_id' => 4],
            ['subject_code' => 'SYS-101', 'name' => 'Systems Analysis', 'level' => 12, 'hrs' => 2, 'department_id' => 4],
            ['subject_code' => 'SEC-101', 'name' => 'Cybersecurity Fundamentals', 'level' => 12, 'hrs' => 2, 'department_id' => 4],
            ['subject_code' => 'OS-101', 'name' => 'Operating Systems', 'level' => 11, 'hrs' => 3, 'department_id' => 4],
        
            // Department 5 - TVL
            ['subject_code' => 'AGRI-101', 'name' => 'Introduction to Agriculture', 'level' => 11, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'HE-101', 'name' => 'Home Economics', 'level' => 11, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'TLE-101', 'name' => 'Technology and Livelihood Education', 'level' => 11, 'hrs' => 2, 'department_id' => 5],
            ['subject_code' => 'CROP-101', 'name' => 'Crop Production', 'level' => 12, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'ANIM-101', 'name' => 'Animal Production', 'level' => 12, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'COOK-101', 'name' => 'Cookery', 'level' => 11, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'WELD-101', 'name' => 'Welding Fundamentals', 'level' => 12, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'ELC-101', 'name' => 'Electrical Installation', 'level' => 11, 'hrs' => 3, 'department_id' => 5],
            ['subject_code' => 'AUTO-101', 'name' => 'Automotive Servicing', 'level' => 12, 'hrs' => 2, 'department_id' => 5],
            ['subject_code' => 'PLUMB-101', 'name' => 'Plumbing Basics', 'level' => 11, 'hrs' => 2, 'department_id' => 5],
        ];
        

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
