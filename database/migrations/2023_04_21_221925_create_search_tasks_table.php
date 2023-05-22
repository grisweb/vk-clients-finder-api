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
        Schema::create('search_tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('title');
            $table->unsignedTinyInteger('age_from')->nullable();
            $table->unsignedTinyInteger('age_to')->nullable();
            $table->unsignedTinyInteger('birth_day')->nullable();
            $table->unsignedTinyInteger('birth_month')->nullable();
            $table->year('birth_year')->nullable();
            $table->unsignedMediumInteger('city')->nullable();
            $table->unsignedSmallInteger('university')->nullable();
            $table->year('university_year')->nullable();
            $table->unsignedSmallInteger('university_faculty')->nullable();
            $table->unsignedSmallInteger('university_chair')->nullable();
            $table->unsignedTinyInteger('sex')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->boolean('has_photo')->nullable();
            $table->string('task_status');
            $table->foreignId('user_id')->constrained('users');
            $table->json('keywords');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_tasks');
    }
};
