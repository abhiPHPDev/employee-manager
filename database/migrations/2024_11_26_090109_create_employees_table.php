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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('country_code');
            $table->string('mobile');
            $table->enum('gender',['male','female','other']);
            $table->string('address')->nullable();
            $table->json('hobbies')->nullable();
            $table->string('photo');
            $table->timestamps();
            $table->index(['first_name', 'last_name']);
            $table->index(['country_code','mobile']);
            $table->index(['gender']);
            $table->softDeletes();//for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
