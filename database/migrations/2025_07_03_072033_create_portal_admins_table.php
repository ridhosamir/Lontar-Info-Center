<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('portal_admins', function (Blueprint $table) {
            $table->id('id_portal_admin');
            $table->string('nama_portal_admin');
            $table->text('keterangan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portal_admins');
    }
};