<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->boolean('is_presence');
            $table->boolean('is_absence');
            $table->string('desc_absence')->nullable();
            $table->boolean('is_permission');
            $table->string('desc_permission')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presences');
    }
};
