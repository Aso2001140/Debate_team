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
        Schema::create('bystanders', function (Blueprint $table) {
            //傍観者ID
            $table->id('b_id')->comment('傍観者ID');
            //foreignIdを使用してroomテーブルのIDを取得している
            $table->foreignId('room_id')->constrained('room');
            //ルームID IDを外部参照しているためunsignedBigIntegerとなっている
            //$table->unsignedBigInteger('room_r_id');

            //foreignIdを使用してuserテーブルのIDを取得している
            $table->foreignId('user_id')->constrained('user');
            //ユーザーID IDを外部参照しているためunsignedBigIntegerとなっている
            //$table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bystanders');
    }
};
