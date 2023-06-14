<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            'Registrar Office',
            'Exam Controller Office',
            'Accounts Office',
        ];

        foreach ($offices as $office) {
            Office::create([
                'name' => $office,
            ]);
        }
    }
}
