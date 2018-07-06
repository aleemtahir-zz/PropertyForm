<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_key_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('volume_no');
            $table->integer('folio_no');
            $table->integer('lot_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_key_id', function (Blueprint $table) {
            //
        });
    }
}
