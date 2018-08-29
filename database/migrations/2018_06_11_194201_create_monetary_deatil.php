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
            $table->integer('price_i')->nullable();
            $table->string('price_w')->nullable();
            $table->integer('j_price_i')->nullable();
            $table->string('j_price_w')->nullable();
            $table->integer('deposit')->nullable();
            $table->integer('second_payment')->nullable();
            $table->integer('final_payment')->nullable();
            $table->float('half_title')->nullable();
            $table->float('half_land_agreement')->nullable();
            $table->float('half_build_agreement')->nullable();
            $table->float('half_stamp_duty')->nullable();
            $table->float('half_reg_fee')->nullable();
            $table->integer('inc_cost')->nullable();
            $table->integer('maintenance_expense')->nullable();
            $table->integer('identification_fee')->nullable();
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
