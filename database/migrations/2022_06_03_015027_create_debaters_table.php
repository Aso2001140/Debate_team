<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debaters', function (Blueprint $table) {
            //討論ID
            $table->id('d_id');
            //ルームID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('room_r_id');
            //ユーザーID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debaters');
    }
};
