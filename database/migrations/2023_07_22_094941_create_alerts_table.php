<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->timestamps();

            $table->integer('user_id');
            $table->string('alert_text');
            $table->boolean('seen')->default(false);
            $table->boolean('send_on_email')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alerts');
    }
};
