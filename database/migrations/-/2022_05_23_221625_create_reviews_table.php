<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('content');
            $table->integer('rating')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('review_model', function (Blueprint $table) {
            $table->foreignId('review_id');
            $table->foreignId('model_id');
            $table->primary(['model_id', 'review_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_model');
        Schema::dropIfExists('reviews');
    }
};
