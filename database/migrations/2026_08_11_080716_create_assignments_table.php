<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->integer('id_assignment')->primary();

            $table->integer('report_id');
            $table->integer('authority_id');

            $table->timestamp('assignment_date')->useCurrent()->nullable();
            $table->timestamp('attended_date')->nullable();

            $table->foreign('report_id')
                ->references('id_report')
                ->on('reports');

            $table->foreign('authority_id')
                ->references('id_user')
                ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
