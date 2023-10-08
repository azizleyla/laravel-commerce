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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name'); 
            $table->boolean('isFavorite'); 
            $table->string('operating_system'); 
            $table->decimal('weight');
            $table->string('color');
            $table->string('process_type');
            $table->integer('guarantee');
            $table->boolean('isCart');
            $table->decimal('current_price');
            $table->text('description')->nullable(); 
            $table->decimal('prev_price')->nullable(); 
            $table->float('rating');
            $table->integer('qty');
            $table->integer('stock');
            $table->integer('product_no');
            $table->string('brand')->nullable();
            $table->integer('sim_cart')->nullable();
            $table->decimal('screen_size')->nullable();
            $table->text('memory')->nullable();
            $table->string('img')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); 
            $table->timestamp('created_at')->useCurrent(); 
            $table->timestamp('updated_at')->useCurrent(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};