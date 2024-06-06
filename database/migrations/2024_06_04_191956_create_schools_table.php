<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('government_name');
            $table->enum('type', ['SD', 'SMP', 'SMA', 'SMK']);
            $table->string('address');
            $table->string('phone');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
