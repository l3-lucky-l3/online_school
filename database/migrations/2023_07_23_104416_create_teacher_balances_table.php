<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_balances', function (Blueprint $table) {
            $table->integer('user_id');
            $table->decimal('balance')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_balances');
    }
};
