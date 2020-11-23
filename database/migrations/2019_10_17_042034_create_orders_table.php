<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('total_price');
            $table->bigInteger('pay_id')->default(0);
            $table->enum('status',['ยังไม่ชำระเงิน','กำลังตรวจสอบการชำระเงิน','ชำระเงินผิดพลาด','ชำระเงินถูกต้องกำลังเตรียมส่ง','จัดส่งเรียบร้อย'])->default('ยังไม่ชำระเงิน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
