<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTagSubCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tag_sub_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');

            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');

            $table->index('service_id');
            $table->index('sub_category_id');
            $table->index(['service_id', 'sub_category_id'], 'service_sub_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_tag_sub_categories');
    }
}
