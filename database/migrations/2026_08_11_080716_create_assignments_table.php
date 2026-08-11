<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id_assignment');

            $table->unsignedInteger('report_id');
            $table->unsignedInteger('authority_id');

            $table->timestamp('assignment_date')->useCurrent();
            $table->timestamp('attended_date')->nullable();

            $table->foreign('report_id')
                ->references('id_report')
                ->on('reports')
                ->onDelete('cascade');

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
