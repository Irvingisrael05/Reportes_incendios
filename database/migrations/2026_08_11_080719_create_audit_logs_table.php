<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            $table->string('table_name', 100);
            $table->string('operation', 10);
            $table->text('record_id');

            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();

            $table->unsignedInteger('changed_by_user_id')->nullable();

            $table->string('changed_by_type', 20)
                ->default('mysql');

            $table->ipAddress('source_ip')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->text('db_user')->nullable();

            $table->foreign('changed_by_user_id')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
