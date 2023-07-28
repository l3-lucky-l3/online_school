<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->text('message_text');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
