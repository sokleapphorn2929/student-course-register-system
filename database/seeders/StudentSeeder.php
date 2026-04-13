<?php

namespace Database\Seeders;

use App\Models\Students;
use App\Models\Users;
use App\Models\Courses;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $user    = Users::first();
        $courses = Courses::all();

        $names = [
            "Sokleap", "Dara", "Bopha", "Ratha", "Sreyleak",
            "Chanthy", "Vibol", "Kosal", "Lida", "Pisey",
            "Sophal", "Makara", "Sokheng", "Vannak", "Chenda",
            "Ratanak", "Monita", "Sambath", "Panha", "Sreymom",
        ];

        $addresses = [
            "Phnom Penh", "Siem Reap", "Battambang",
            "Kampot", "Kandal", "Takeo", "Kampong Cham",
            "Prey Veng", "Svay Rieng", "Pursat",
        ];

        $students = [];

        for ($i = 1; $i <= 100; $i++) {
            $students[] = [
                "user_id"     => $user->_id,
                "std_name"    => $names[array_rand($names)] . " " . $names[array_rand($names)],
                "std_phone"   => "0" . rand(10, 99)  . rand(100, 999)  . rand(1000, 9999),
                "std_address" => $addresses[array_rand($addresses)],
                "std_dob"     => date("Y-m-d", strtotime("-" . rand(18, 30) . " years -" . rand(0, 365) . " days")),
                "course_id"   => $courses[array_rand($courses->toArray())]->_id,
                "created_at"  => now(),
                "updated_at"  => now(),
            ];
        }

        Students::insert($students);
    }
}