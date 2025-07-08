<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('safety_performance_records', function (Blueprint $table) {
            $table->id();
            // MENGGANTI year dan month DENGAN record_date
            $table->date('record_date')->unique(); // Data unik untuk setiap tanggal
            
            $table->unsignedBigInteger('total_man_hours')->default(0);
            $table->integer('fatality')->default(0);
            $table->integer('property_damage')->default(0);
            $table->date('latest_accident_date')->nullable();
            $table->integer('total_accident_this_month')->default(0);
            $table->integer('man_power')->default(0);
            $table->integer('lost_time_injury')->default(0);
            $table->integer('lost_working_day')->default(0);
            $table->integer('medical_treatment_injury')->default(0);
            $table->integer('ppe_violation')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('safety_performance_records');
    }
};