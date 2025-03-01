<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefererLastToVisitor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('visitor', function (Blueprint $table) {
            $table->string('referer_last')->after('referer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('visitor', function (Blueprint $table) {
            $table->dropColumn('referer_last');
        });
    }
}
