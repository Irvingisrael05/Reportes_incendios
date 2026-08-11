<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('id_report')->primary();

            $table->integer('user_id');
            $table->integer('ecosystem_id');
            $table->integer('weather_id');
            $table->integer('status_id');

            $table->decimal('latitude');
            $table->decimal('longitude');

            $table->timestamp('report_date')->useCurrent()->nullable();
            $table->text('description');

            $table->string('municipality', 100)->default('Unknown');
            $table->string('locality', 150)->default('Unknown');

            $table->integer('category_id')->nullable();

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users');

            $table->foreign('ecosystem_id')
                ->references('id_ecosystem')
                ->on('ecosystems');

            $table->foreign('weather_id')
                ->references('id_weather')
                ->on('weather_conditions');

            $table->foreign('status_id')
                ->references('id_status')
                ->on('report_status');

            $table->foreign('category_id')
                ->references('id_category')
                ->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
