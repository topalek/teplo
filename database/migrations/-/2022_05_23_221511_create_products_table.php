<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->foreignId('category_id');
            $table->integer('price');
            $table->boolean('published')->default(false);
            $table->timestamps();
        });

        Schema::create('product_option', function (Blueprint $table) {
            $table->foreignId('product_id');
            $table->foreignId('option_id');
            $table->primary(['option_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option');
        Schema::dropIfExists('products');
    }
};
