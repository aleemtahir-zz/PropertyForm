<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevelopementDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_developement_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('volume_no')->nullable();
            $table->string('folio_no')->nullable();
            $table->string('volume_str')->nullable();
            $table->string('folio_str')->nullable();
            $table->string('plan_no')->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('tbl_address'); 
            $table->integer('surveyor_id')->unsigned()->nullable(); 
            $table->foreign('surveyor_id')->references('id')->on('tbl_person_info');
            $table->integer('developer_id')->unsigned()->nullable(); 
            $table->foreign('developer_id')->references('id')->on('tbl_developer_detail');
            $table->integer('contractor_id')->unsigned()->nullable(); 
            $table->foreign('contractor_id')->references('id')->on('tbl_contractor_detail');
            $table->integer('payment_id')->unsigned()->nullable(); 
            $table->foreign('payment_id')->references('id')->on('tbl_dev_contract_payment');
            $table->integer('total_lots_i')->nullable();
            $table->string('total_lots_s')->nullable();
            $table->integer('residential_lots_i')->nullable();
            $table->string('residential_lots_s')->nullable();
            $table->integer('common_lots_i')->nullable();
            $table->string('common_lots_s')->nullable();
            $table->string('lot_ids')->nullable();
            $table->string('rsrv_road_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_developement_detail');
    }
}
