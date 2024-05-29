<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('parent_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('phone_number');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parent_profiles');
    }
}
