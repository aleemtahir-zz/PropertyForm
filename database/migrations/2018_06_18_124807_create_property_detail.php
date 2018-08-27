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
            // $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('volume_no')->unsigned()->nullable();
            $table->integer('folio_no')->unsigned()->nullable();
            $table->integer('lot_no')->unsigned();
            $table->string('dev_name');
            $table->integer('plan_no')->nullable();
            $table->integer('dev_id')->unsigned()->nullable(); 
            $table->foreign('dev_id')->references('id')->on('tbl_developement_detail');
            $table->integer('attorney_id')->unsigned()->nullable(); 
            $table->foreign('attorney_id')->references('id')->on('tbl_attorney_detail');
            $table->integer('payment_id')->unsigned()->nullable(); 
            $table->foreign('payment_id')->references('id')->on('tbl_monetary_detail');
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('tbl_address');
            // $table->primary(['volume_no','folio_no','lot_no']); 
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
