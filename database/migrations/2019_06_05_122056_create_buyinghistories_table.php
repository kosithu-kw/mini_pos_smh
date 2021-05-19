<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyinghistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyinghistories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('item_name');
            $table->double('buying_price');
            $table->double('sale_price');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->date('buying_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyinghistories');
    }
}
