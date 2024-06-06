<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_schools', function (Blueprint $table) {
            $table->uuid('student_id');
            $table->uuid('school_id');
            $table->boolean('is_active');
            $table->boolean('is_graduated');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

            $table->primary(['student_id', 'school_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_schools');
    }
};
