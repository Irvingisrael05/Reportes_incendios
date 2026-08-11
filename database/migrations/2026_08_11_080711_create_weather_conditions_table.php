<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_conditions', function (Blueprint $table) {
            $table->increments('id_weather');

            $table->decimal('temperature', 8, 2)->nullable();
            $table->decimal('humidity', 8, 2)->nullable();
            $table->decimal('precipitation', 8, 2)->nullable();
            $table->decimal('wind_speed', 8, 2)->nullable();
            $table->string('wind_direction', 50)->nullable();
            $table->decimal('atmospheric_pressure', 10, 2)->nullable();
            $table->decimal('cloudiness', 8, 2)->nullable();

            $table->timestamp('record_date')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_conditions');
    }
};
