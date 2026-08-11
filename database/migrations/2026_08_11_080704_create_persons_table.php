<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id_person');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamp('registration_date')->useCurrent();
            $table->string('email', 100)->nullable()->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
