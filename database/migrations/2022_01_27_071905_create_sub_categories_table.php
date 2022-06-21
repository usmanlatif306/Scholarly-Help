<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('price_type_id')->default(3);
            $table->foreign('price_type_id')
                ->references('id')
                ->on('price_types');
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('single_spacing_price', 10, 2);
            $table->decimal('double_spacing_price', 10, 2);
            $table->unsignedInteger('minimum_order_quantity')->default(1)->nullable();
            $table->decimal('single_spacing_price', 10, 2)->nullable();
            $table->decimal('double_spacing_price', 10, 2)->nullable();
            $table->boolean('inactive')->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
}
