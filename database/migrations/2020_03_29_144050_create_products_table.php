<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('price')->default(2500);
            $table->integer('balance')->default(1000);
            $table->text('detail_text')->nullable();
            $table->text('preview_text')->nullable();
            $table->text('composition')->nullable();
            $table->text('features')->nullable();
            $table->text('size')->nullable();
            $table->text('manufacturer')->nullable();
            $table->integer('manufacturer_id')->nullable();
            $table->text('delivery')->nullable();
            $table->integer('delivery_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('views')->default(0);
            $table->integer('is_featured')->default(0);
            $table->integer('views_count')->default(0);
            $table->float('stars')->default(100);
            $table->string('image')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('products');
    }
}
