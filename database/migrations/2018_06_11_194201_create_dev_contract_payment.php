<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevContractPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dev_contract_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fc_id')->unsigned()->nullable(); 
            $table->foreign('fc_id')->references('id')->on('tbl_foriegn_currency'); 
            $table->string('price_i')->nullable();
            $table->string('price_w')->nullable();
            $table->string('j_price_i')->nullable();
            $table->string('j_price_w')->nullable();
            $table->string('deposit')->nullable();
            $table->string('deposit_w')->nullable();
            $table->string('second_payment')->nullable();
            $table->string('third_payment')->nullable();
            $table->string('fourth_payment')->nullable();
            $table->string('final_payment')->nullable();
            $table->string('title_cost')->nullable();
            $table->string('land_agreement_cost')->nullable();
            $table->string('build_agreement_cost')->nullable();
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
        Schema::dropIfExists('tbl_dev_contract_payment');
    }
}
