<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttorneyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_attorney_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->nullable();
            $table->integer('officer_id')->unsigned()->nullable(); 
            $table->foreign('officer_id')->references('id')->on('tbl_person_info');
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
        Schema::dropIfExists('tbl_attorney_detail');
    }
}
