<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $collection) {
            $collection->id("id");
            $collection->objectId('teacher_id')->nullable();
            $collection->string("course_title")->unique();
            $collection->text("course_description")->nullable();
            $collection->decimal("courser_price",5,2);
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
