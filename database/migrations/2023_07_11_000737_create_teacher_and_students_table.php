<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_and_students', function (Blueprint $table) {
            $table->integer('student_id');
            $table->integer('teacher_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_and_students');
    }
};
