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
        Schema::create('enrollments', function (Blueprint $collection) {
            $collection->id();
            $collection->objectId("std_id")->nullable();
            $collection->objectId("course_id")->nullable();
            $collection->string("status");
            $collection->date("enrolled_at");
            $collection->string("payment_status");
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
