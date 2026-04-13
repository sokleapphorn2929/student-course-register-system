<?php

namespace Database\Seeders;

use App\Models\Teachers;
use App\Models\Users;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $user = Users::first(); // ← define $user first

        Teachers::insert([  // ← use Teachers model, wrap all in one array
            [
                "user_id"         => $user->_id,
                "teacher_name"    => "John Smith",
                "teacher_phone"   => "0123456789",
                "teacher_address" => "123 Main St, Phnom Penh",
                "teacher_dob"     => "1985-04-10",
                "hired_date"      => "2020-01-15",
            ],
            [
                "user_id"         => $user->_id,
                "teacher_name"    => "Sarah Johnson",
                "teacher_phone"   => "0129876543",
                "teacher_address" => "456 River Rd, Siem Reap",
                "teacher_dob"     => "1990-08-22",
                "hired_date"      => "2021-03-01",
            ],
            [
                "user_id"         => $user->_id,
                "teacher_name"    => "David Lee",
                "teacher_phone"   => "0112223333",
                "teacher_address" => "789 Lake Ave, Battambang",
                "teacher_dob"     => "1988-12-05",
                "hired_date"      => "2019-06-20",
            ],
            [
                "user_id"         => $user->_id,
                "teacher_name"    => "Emily Chan",
                "teacher_phone"   => "0104445555",
                "teacher_address" => "321 Palm St, Kampot",
                "teacher_dob"     => "1992-03-17",
                "hired_date"      => "2022-09-10",
            ],
            [
                "user_id"         => $user->_id,
                "teacher_name"    => "Michael Tan",
                "teacher_phone"   => "0156667777",
                "teacher_address" => "654 Hill Rd, Kandal",
                "teacher_dob"     => "1983-07-30",
                "hired_date"      => "2018-11-05",
            ],
        ]);
    }
}