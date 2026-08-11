<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_status', function (Blueprint $table) {
            $table->increments('id_status');
            $table->string('description', 50)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_status');
    }
};
