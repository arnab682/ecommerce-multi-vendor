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
       
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('sort_title')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_oppenings', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('rate');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->double('rate');
            $table->bigInteger('sku')->nullable();
            $table->foreignId('vendor_id')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('opening_id')->constrained('product_oppenings')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('category_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->softDeletes();
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
        Schema::dropIfExists('product_oppenings');
        Schema::dropIfExists('units');

    }
};
