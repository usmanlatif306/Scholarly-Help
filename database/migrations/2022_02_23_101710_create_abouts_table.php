<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading');
            $table->string('top_content')->nullable();
            $table->text('top_section_content')->nullable();
            $table->text('subject_specialist_heading')->nullable();
            $table->text('subject_specialist_content')->nullable();
            $table->text('mission_heading')->nullable();
            $table->text('mission_content')->nullable();
            $table->text('vision_heading')->nullable();
            $table->text('vision_content')->nullable();
            $table->text('email_1')->nullable();
            $table->text('email_2')->nullable();
            $table->text('number')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
