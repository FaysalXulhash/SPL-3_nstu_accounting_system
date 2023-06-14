<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin' => 'Admin',
            'register_officer' => 'Registrar Officer',
            'exam_controller' => 'Exam Controller',
            'sub_exam_controller' => 'Sub Exam Controller',
            'exam_board_director' => 'Exam Board Director',
            'accounts_section_officer' => 'Accounts Section Officer',
            'vc' => 'Vice Chancellor',
            'treasurer' => 'Treasurer',
            'accounts_director' => 'Accounts Director',
            'dept_chairman' => 'Department Chairman',
            'teacher' => 'Teacher',
            'staff' => 'Staff',
            'user' => 'User',
        ];

        foreach ($roles as $code => $title) {
            Role::create([
                'title' => $title,
                'code' => $code,
            ]);
        }
    }
}
