<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->string('mac_nic', 100);
            $table->foreign('mac_nic')->references('mac_address')->on('nic');
            $table->string('mac_device', 100);
            $table->foreign('mac_device')->references('mac_address')->on('devices');
            $table->timestamps();
            $table->dateTime('date_in');
            $table->dateTime('date_out');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associations');
    }
}
