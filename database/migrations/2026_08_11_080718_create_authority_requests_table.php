<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authority_requests', function (Blueprint $table) {
            $table->integer('id_request')->primary();

            $table->integer('user_id');

            $table->string('company_name', 150);
            $table->string('company_key', 100);
            $table->string('employee_key', 100);
            $table->string('company_location', 200);

            $table->string('status', 20)->default('pending');

            $table->timestamp('request_date')->useCurrent()->nullable();
            $table->timestamp('response_date')->nullable();

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authority_requests');
    }
};
