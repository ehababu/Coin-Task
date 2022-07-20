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
        Schema::create('products', function (Blueprint $table) {
            
                $table->id();
                $table->string('name');
                $table->string('barcode');
                $table->foreign('category_id')->on('categories')->references('id')->cascadeOnDelete();
                $table->string('description');
                $table->string('image');
                $table->string('keywords');
                $table->boolean('is_active');
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
};
