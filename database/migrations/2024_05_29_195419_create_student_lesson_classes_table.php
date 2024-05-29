<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLessonClassesTable extends Migration
{
    public function up()
    {
        Schema::create('student_lesson_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->uuid('lesson_class_id');
            $table->boolean('is_presence')->default(false);
            $table->boolean('is_permission')->default(false);
            $table->text('permission_detail')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('lesson_class_id')->references('id')->on('lesson_classes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_lesson_classes');
    }
}
