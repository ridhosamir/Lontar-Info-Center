<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portal_utamas', function (Blueprint $table) {
            // Add click_count column with default value of 0 if it doesn't exist
            if (!Schema::hasColumn('portal_utamas', 'click_count')) {
                $table->integer('click_count')->default(0)->after('link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portal_utamas', function (Blueprint $table) {
            if (Schema::hasColumn('portal_utamas', 'click_count')) {
                $table->dropColumn('click_count');
            }
        });
    }
};