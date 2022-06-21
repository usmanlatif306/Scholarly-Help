<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading');
            $table->string('top_content')->nullable();
            $table->text('top_section_content')->nullable();
            $table->text('way_1_heading')->nullable();
            $table->text('way_1_content')->nullable();
            $table->text('way_1_email')->nullable();
            $table->text('way_2_heading')->nullable();
            $table->text('way_2_content')->nullable();
            $table->text('way_2_email')->nullable();
            $table->text('way_3_heading')->nullable();
            $table->text('way_3_content')->nullable();
            $table->text('way_3_number')->nullable();
            $table->text('hub_heading')->nullable();
            $table->text('hub_1_heading')->nullable();
            $table->text('hub_1_content')->nullable();
            $table->text('hub_2_heading')->nullable();
            $table->text('hub_2_content')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
