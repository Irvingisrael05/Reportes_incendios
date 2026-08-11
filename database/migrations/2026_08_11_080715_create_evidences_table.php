<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evidences', function (Blueprint $table) {
            $table->integer('id_evidence')->primary();

            $table->integer('report_id');
            $table->integer('user_id');
            $table->integer('category_id');

            $table->string('url', 255)->nullable();
            $table->timestamp('evidence_date')->useCurrent()->nullable();

            $table->foreign('report_id')
                ->references('id_report')
                ->on('reports');

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users');

            $table->foreign('category_id')
                ->references('id_category')
                ->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidences');
    }
};
