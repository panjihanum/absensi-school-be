<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->uuid('student_id');
            $table->uuid('parent_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parent_profiles')->onDelete('cascade');

            $table->primary(['student_id', 'parent_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_parents');
    }
};
