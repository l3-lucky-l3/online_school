<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('question');
            $table->string('name');
            $table->integer('user_id');
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
        Schema::dropIfExists('lessons');
    }
};
