<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonetaryDeatil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_monetary_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fc_id')->unsigned()->nullable(); 
            $table->foreign('fc_id')->references('id')->on('tbl_foriegn_currency'); 
            $table->string('price_i')->nullable();
            $table->string('price_w')->nullable();
            $table->string('j_price_i')->nullable();
            $table->string('j_price_w')->nullable();
            $table->string('deposit')->nullable();
            $table->string('second_payment')->nullable();
            $table->string('final_payment')->nullable();
            $table->string('half_title')->nullable();
            $table->string('half_land_agreement')->nullable();
            $table->string('half_build_agreement')->nullable();
            $table->string('half_stamp_duty')->nullable();
            $table->string('half_reg_fee')->nullable();
            $table->string('inc_cost')->nullable();
            $table->string('maintenance_expense')->nullable();
            $table->string('identification_fee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_monetary_detail', function (Blueprint $table) {
            //
        });
    }
}
