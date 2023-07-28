<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('minute_costs', function (Blueprint $table) {
            $table->decimal('minute_cost', 3, 0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('minute_costs');
    }
};
