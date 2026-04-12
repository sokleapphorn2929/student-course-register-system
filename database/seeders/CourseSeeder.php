<?php

namespace Database\Seeders;

use App\Models\Courses;
use App\Models\Teachers;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = Teachers::all();

        Courses::insert([
            [
                "teacher_id"         => $teachers[0]->_id,
                "course_title"       => "Web Development Fundamentals",
                "course_description" => "Learn HTML, CSS, and JavaScript from scratch.",
                "course_price"       => 99.99,
            ],
            [
                "teacher_id"         => $teachers[1]->_id,
                "course_title"       => "Python for Beginners",
                "course_description" => "Introduction to Python programming and data structures.",
                "course_price"       => 79.99,
            ],
            [
                "teacher_id"         => $teachers[2]->_id,
                "course_title"       => "Database Design with MongoDB",
                "course_description" => "Master NoSQL database design and queries.",
                "course_price"       => 89.99,
            ],
            [
                "teacher_id"         => $teachers[3]->_id,
                "course_title"       => "Laravel Framework Mastery",
                "course_description" => "Build modern web applications using Laravel.",
                "course_price"       => 119.99,
            ],
            [
                "teacher_id"         => $teachers[4]->_id,
                "course_title"       => "UI/UX Design Essentials",
                "course_description" => "Learn design principles and tools like Figma.",
                "course_price"       => 69.99,
            ],
        ]);
    }
}