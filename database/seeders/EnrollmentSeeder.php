<?php

namespace Database\Seeders;

use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\Students;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $studentIds      = Students::all()->map(fn($s) => (string) $s->_id)->toArray();
        $courseIds       = Courses::all()->map(fn($c) => (string) $c->_id)->toArray();
        $statuses        = ['active', 'pending', 'completed', 'dropped'];
        $paymentStatuses = ['paid', 'unpaid', 'refunded'];

        // Safety check
        if (empty($studentIds) || empty($courseIds)) {
            $this->command->error('No students or courses found! Seed those first.');
            return;
        }

        $this->command->info('Found ' . count($studentIds) . ' students and ' . count($courseIds) . ' courses.');

        for ($i = 0; $i < 79; $i++) {
            Enrollments::create([
                'std_id'         => $faker->randomElement($studentIds),
                'course_id'      => $faker->randomElement($courseIds),
                'status'         => $faker->randomElement($statuses),
                'enrolled_at'    => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'payment_status' => $faker->randomElement($paymentStatuses),
            ]);
        }

        $this->command->info('79 enrollments created successfully!');
    }
}