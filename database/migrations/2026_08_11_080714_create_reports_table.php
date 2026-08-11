<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id_report');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ecosystem_id');
            $table->unsignedInteger('weather_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('category_id')->nullable();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamp('report_date')->useCurrent();
            $table->text('description');

            $table->string('municipality', 100)->default('Unknown');
            $table->string('locality', 150)->default('Unknown');

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
                ->on('categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
