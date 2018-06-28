<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_purchaser_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('suffix')->nullable();
            $table->string('trn_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('bussiness_place')->nullable();
            $table->string('phone')->nullable(); 
            $table->string('mobile')->nullable(); 
            $table->string('email')->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('tbl_address'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_purchaser_detail');
    }
}
