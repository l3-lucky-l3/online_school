<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_minutes', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('minutes')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_minutes');
    }
};
