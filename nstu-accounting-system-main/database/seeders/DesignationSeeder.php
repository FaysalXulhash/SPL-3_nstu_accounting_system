<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [
            'Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor',
            'Assistant Registrar', 'Section Officer', 'Clerk', 'Peon', 'Driver', 'Cleaner',
            'Registrar Officer', 'Exam Controller', 'Sub Exam Controller', 'Exam Board Director',
            'Accounts Section Officer', 'Vice Chancellor', 'Treasurer', 'Accounts Director',
            'Department Chairman', 'Unknown',
            'Security Guard', 'Librarian', 'Assistant Librarian',  'Lab Assistant', 'Technical Assistant',
            'Technical Officer', 'Research Assistant', 'Research Associate', 'Research Scientist',
            'Administrative Officer', 'Assistant Administrative Officer', 'Office Assistant',
            'Accounts Officer', 'Assistant Accounts Officer', 'Accountant',
            'Auditor', 'Assistant Auditor', 'Computer Operator', 'System Administrator',
            'Network Administrator', 'IT Support Staff', 'Marketing Officer', 'Events Coordinator',
        ];
        foreach ($designations as $designation) {
            Designation::create([
                'name' => $designation,
            ]);
        }
    }
}
