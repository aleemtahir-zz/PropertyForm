<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyBuyerAssoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_property_buyer_assoc', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('property_id')->unsigned();
            $table->integer('purchaser_id')->unsigned();
            $table->primary(['property_id','purchaser_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_property_buyer_assoc', function (Blueprint $table) {
            //
        });
    }
}
