<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '$2y$10$SmrPjAMwLzUAEcUQi.onE.lCz52fIGOSFUHD1f63n5kXxx2AEwOwK'; // 12345678

        $roles = Role::all();
        $designations = Designation::pluck('id', 'name')->toArray();
        $offices = Office::pluck('id')->toArray();

        $departments = Department::pluck('id')->toArray();

        foreach ($roles as $role) {

            $designation_id = null;
            if ($role->title == "Admin") {
                $designation_id = $designations['System Administrator'];
            } else if ($role->title == 'Teacher') {
                $designation_id = $designations['Assistant Professor'];
            } else if ($role->title == 'Staff') {
                $designation_id = $designations['Office Assistant'];
            } else if (array_key_exists($role->title, $designations)) {
                $designation_id = $designations[$role->title];
            } else {
                $designation_id = $designations['Unknown'];
            }

            if ($role->id < 10) {
                User::create([
                    'name' => $role->title,
                    'email' => strtolower(str_replace(' ', '', $role->title)) . '@nstu.edu.bd',
                    'email_verified_at' => now(),
                    'mobile' => fake()->unique()->regexify('01[3-9][0-9]{8}'),
                    'password' => $password,
                    'role_id' => $role->id,
                    'designation_id' => $designation_id,
                    'from_type' => Office::class,
                    'from_id' => fake()->randomElement($offices),
                ]);
            } else {
                // for ($i=0; $i < 5; $i++) {
                foreach ($departments as $department_id) {
                    User::create([
                        'name' => $role->title . $department_id,
                        'email' => strtolower(str_replace(' ', '', $role->title)) . $department_id . '@nstu.edu.bd',
                        'email_verified_at' => now(),
                        'mobile' => fake()->unique()->regexify('01[3-9][0-9]{8}'),
                        'password' => $password,
                        'role_id' => $role->id,
                        'designation_id' => $designation_id,
                        'from_type' => Department::class,
                        'from_id' => $department_id,
                    ]);
                }
            }
        }
    }
}
