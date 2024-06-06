<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('nis')->unique();
            $table->string('nisn')->unique();
            $table->string('gender');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
