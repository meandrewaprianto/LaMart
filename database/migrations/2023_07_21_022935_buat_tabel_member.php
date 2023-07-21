<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('member', function(Blueprint $table){
            $table->increments('id_member');
            $table->bigInteger('kode_member')->unsigned();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('telpon', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('member');
    }
};
