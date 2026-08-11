<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_conditions', function (Blueprint $table) {
            $table->integer('id_weather')->primary();
            $table->decimal('temperature')->nullable();
            $table->decimal('humidity')->nullable();
            $table->decimal('precipitation')->nullable();
            $table->decimal('wind_speed')->nullable();
            $table->string('wind_direction', 50)->nullable();
            $table->decimal('atmospheric_pressure')->nullable();
            $table->decimal('cloudiness')->nullable();
            $table->timestamp('record_date')->useCurrent()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_conditions');
    }
};
