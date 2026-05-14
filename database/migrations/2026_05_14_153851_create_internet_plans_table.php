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
        Schema::create('internet_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 8, 2)->index();
            $table->integer('data_limit')->nullable()->comment('Limit in GB');
            $table->integer('time_limit')->nullable()->comment('Limit in minutes/hours');
            $table->string('speed_limit')->nullable()->comment('Mikrotik rate limit e.g., 5M/1M');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internet_plans');
    }
};
