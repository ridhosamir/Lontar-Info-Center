<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('portal_utamas', function (Blueprint $table) {
            $table->id('id_portal_utama');
            $table->string('nama_portal_user');
            $table->text('keterangan_user')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portal_utamas');
    }
};