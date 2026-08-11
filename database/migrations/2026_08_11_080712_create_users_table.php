<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_user')->primary();

            $table->integer('person_id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('status', 20)->default('active');
            $table->integer('role_id');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            $table->foreign('person_id')
                ->references('id_person')
                ->on('persons');

            $table->foreign('role_id')
                ->references('id_role')
                ->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
