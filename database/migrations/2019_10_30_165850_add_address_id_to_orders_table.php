<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->bigInteger('address_id')->unsigned()->after('id');
          $table->foreign('address_id')
              ->references('id')
              ->on('addresses')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('orders', function (Blueprint $table) {
          $table->dropForeign(['address_id']);
          $table->dropColumn('address_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}
