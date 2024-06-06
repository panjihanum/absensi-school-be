<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->uuid('homeroom_teacher_id');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('homeroom_teacher_id')->references('id')->on('teacher_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_classes');
    }
};
