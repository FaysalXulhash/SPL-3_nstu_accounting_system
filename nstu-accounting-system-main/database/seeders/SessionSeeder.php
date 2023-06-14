<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($year = 2006; $year < 2023; $year++) {
            Session::create([
                'start_year' => $year,
                'end_year' => $year + 1,
                'label' => $year . '-' . ($year + 1),
            ]);
        }
    }
}
