<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fusers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->integer('mob');
            $table->date('dob');
            $table->enum('gender', ['male', 'female', 'other']); // Specify enum values here
            $table->string('email');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('image');// -> nullable(); // Assuming photo is optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fusers');
    }
};
