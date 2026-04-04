<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('mongodb')->table('students')->insert([
            'std_name' => 'Sokleap',
            'std_phone' => '0972843289',
            'std_address' => 'Phnom Penh',
            'std_dob' => '2000-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
