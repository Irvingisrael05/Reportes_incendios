<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');

            $table->unsignedInteger('person_id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('status', 20)->default('active');
            $table->unsignedInteger('role_id');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('person_id')
                ->references('id_person')
                ->on('persons')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id_role')
                ->on('roles')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
