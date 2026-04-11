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
        Schema::create('teachers', function (Blueprint $collection) {
            $collection->id();
            $collection->objectId('user_id')->nullable();
            $collection->string("teacher_name");
            $collection->string("teacher_phone");
            $collection->string("teacher_address");
            $collection->date("teacher_dob");
            $collection->date("hired_date");
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
