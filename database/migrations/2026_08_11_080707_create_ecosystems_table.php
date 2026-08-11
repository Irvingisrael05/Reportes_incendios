<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecosystems', function (Blueprint $table) {
            $table->integer('id_ecosystem')->primary();
            $table->string('description', 150)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecosystems');
    }
};
