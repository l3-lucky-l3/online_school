<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('additional_information', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('teacher_subject')->default('');
            $table->string('teacher_classes')->default('');
            $table->string('teacher_comment')->default('');
        });
    }

    public function down()
    {
        Schema::dropIfExists('additional_information');
    }
};
