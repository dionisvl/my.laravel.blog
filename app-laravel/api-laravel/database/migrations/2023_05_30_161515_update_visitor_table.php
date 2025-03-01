<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVisitorTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table('visitor', static function (Blueprint $table) {
            $table->string('target', 1000)->nullable();
        });
    }
}
