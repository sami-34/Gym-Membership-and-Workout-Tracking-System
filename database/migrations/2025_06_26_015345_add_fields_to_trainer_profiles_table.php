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
        Schema::table('trainer_profiles', function (Blueprint $table) {
             $table->integer('experience_years')->default(0);
            $table->string('specialization')->nullable();
            $table->string('workout_types')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            $table->dropColumn(['experience_years', 'specialization', 'workout_types']);
        });
    }
};
