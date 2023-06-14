<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ["Department of Computer Science and Telecommunication Engineering", "CSTE"],
            ["Department of Applied Chemistry and Chemical Engineering", "ACCE"],
            ["Department of Information and Communication Engineering", "ICE"],
            ["Department of Electrical and Electronic Engineering", "EEE"],
            ["Department of Fisheries and Marine Science", "FIMS"],
            ["Department of Pharmacy", ""],
            ["Department of Microbiology", ""],
            ["Department of Applied Mathematics", ""],
            ["Department of Food Technology and Nutrition Science", "FTNS"],
            ["Department of Environmental Science and Disaster Management", "ESDM"],
            ["Department of Biotechnology and Genetic Engineering", "BGE"],
            ["Department of Agriculture", ""],
            ["Department of Statistics", ""],
            ["Department of Oceanography", ""],
            ["Department of Biochemistry and Molecular Biology", "BMB"],
            ["Department of Zoology", ""],
            ["Department of Soil, Water and Environment", ""],
            ["Department of Chemistry", ""],
            ["Department of Physics", ""],
            ["Department of English", ""],
            ["Department of Economics", ""],
            ["Department of Bangladesh and Muktijuddho Studies", "BMS"],
            ["Department of Sociology", ""],
            ["Department of Bangla", ""],
            ["Department of Social Work", ""],
            ["Department of Business Administration", "DBA"],
            ["Department of Management information Systems", "MIS"],
            ["Department of Tourism and Hospitality Management", "THM"],
            ["Department of Education", ""],
            ["Department of Educational Administration", ""],
            ["Department of Law", ""],
            ["Department of Information Sciences and Library Management", "ISLM"],
            ["Software Engineering", "SE"],
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department[0],
                'short_name' => $department[1],
            ]);
        }
    }
}
