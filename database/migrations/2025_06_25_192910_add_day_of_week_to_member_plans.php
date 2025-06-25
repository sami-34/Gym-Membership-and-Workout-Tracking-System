<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('member_workouts', function (Blueprint $table) {
            $table->tinyInteger('day_of_week')->nullable()->after('workout_id');
        });

        Schema::table('member_diets', function (Blueprint $table) {
            $table->tinyInteger('day_of_week')->nullable()->after('diet_plan_id');
        });
    }

    public function down(): void {
        Schema::table('member_workouts', function (Blueprint $table) {
            $table->dropColumn('day_of_week');
        });

        Schema::table('member_diets', function (Blueprint $table) {
            $table->dropColumn('day_of_week');
        });
    }
};
