<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_fields_to_workouts_and_dietplans.php
    public function up()
    {
        Schema::table('workouts', function (Blueprint $table) {
            $table->integer('reps')->nullable();
            $table->integer('sets')->nullable();
        });

        Schema::table('diet_plans', function (Blueprint $table) {
            $table->integer('duration_weeks')->nullable();
            $table->integer('calories')->nullable();
            $table->integer('meals_per_day')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workouts_and_dietplans', function (Blueprint $table) {
            //
        });
    }
};
