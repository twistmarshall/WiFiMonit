<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nic', function (Blueprint $table) {
            $table->string('mac_address', 100)->unique();
            $table->string('ssid',100)->unique();
            $table->integer('channel');
            $table->integer('pwr');
            $table->integer('beacons');
            $table->integer('speed');
            $table->unsignedBigInteger('id_ap');
            $table->foreign('id_ap')->references('id')->on('accesspoints');
            $table->dateTime('date_in');
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
        Schema::dropIfExists('nic');
    }
}
