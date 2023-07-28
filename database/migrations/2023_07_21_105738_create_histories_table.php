<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->integer('student_id');
            $table->integer('teacher_id');
            $table->integer('lesson_id');
            $table->string('student_name');
            $table->text('question');
            $table->integer('number_class')->unsigned();
            $table->string('subject');
            $table->dateTime('start_time');
            $table->integer('duration')->unsigned();
            $table->integer('pause')->unsigned()->default(0);
            $table->decimal('cost')->unsigned();   
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
