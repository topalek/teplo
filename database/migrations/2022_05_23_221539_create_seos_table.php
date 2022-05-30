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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('h1');
            $table->text('text');
            $table->string('title');
            $table->text('keywords');
            $table->text('description');
            $table->boolean('noindex')->default(0);
            $table->boolean('nofollow')->default(0);
            $table->boolean('in_sitemap')->default(1);
            $table->boolean('is_canonical')->default(0);
            $table->timestamps();
        });

        Schema::create('seo_model', function (Blueprint $table) {
            $table->foreignId('seo_id');
            $table->foreignId('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_model');
        Schema::dropIfExists('seos');
    }
};
