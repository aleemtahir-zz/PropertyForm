<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_property_detail', function (Blueprint $table) {
            $table->string('id')->nullable();
            $table->string('lot_no')->nullable();
            $table->string('folio_no')->nullable();
            $table->string('plan_no')->nullable();
            $table->integer('developer_id')->unsigned()->nullable(); 
            $table->foreign('developer_id')->references('id')->on('tbl_developer_detail');
            $table->integer('purchaser_id')->unsigned()->nullable(); 
            $table->foreign('purchaser_id')->references('id')->on('tbl_purchaser_detail');
            $table->integer('attorney_id')->unsigned()->nullable(); 
            $table->foreign('attorney_id')->references('id')->on('tbl_attorney_detail');
            $table->integer('payment_id')->unsigned()->nullable(); 
            $table->foreign('payment_id')->references('id')->on('tbl_dev_contract_payment');
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('tbl_address');
            $table->primary(array('id', 'lot_no')); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_property_detail');
    }
}
