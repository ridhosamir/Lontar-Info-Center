<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('portal_utamas', function (Blueprint $table) {
            $table->string('link')->nullable()->after('keterangan_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('portal_utamas', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
};
