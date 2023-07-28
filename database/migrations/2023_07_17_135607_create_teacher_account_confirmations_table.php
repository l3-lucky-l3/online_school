<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_account_confirmations', function (Blueprint $table) {
            $table->integer('user_id');
            $table->boolean('account_confirmation')->default(false);;
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_account_confirmations');
    }
};
