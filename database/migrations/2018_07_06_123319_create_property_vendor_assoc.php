<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyVendorAssoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_property_vendor_assoc', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('property_id')->unsigned();
            $table->integer('developer_id')->unsigned();
            $table->primary(['property_id','developer_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_property_vendor_assoc', function (Blueprint $table) {
            //
        });
    }
}
