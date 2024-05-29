<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonClassesTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('lesson');
            $table->date('date_lesson');
            $table->time('start_time_lesson');
            $table->time('end_time_lesson');
            $table->uuid('teacher_id');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teacher_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_classes');
    }
}
