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
        Schema::create('found_users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->integer('vk_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_closed');
            $table->dateTime('last_seen')->nullable();
            $table->foreignId('task_id')->constrained('search_tasks');
            $table->string('img_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_users');
    }
};
