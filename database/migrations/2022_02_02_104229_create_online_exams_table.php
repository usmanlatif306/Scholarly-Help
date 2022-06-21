<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_exams', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading')->nullable();
            $table->text('top_content')->nullable();
            $table->text('section1_heading')->nullable();
            $table->string('choose1_heading')->nullable();
            $table->text('choose1_content')->nullable();
            $table->string('choose2_heading')->nullable();
            $table->text('choose2_content')->nullable();
            $table->string('choose3_heading')->nullable();
            $table->text('choose3_content')->nullable();
            $table->string('choose4_heading')->nullable();
            $table->text('choose4_content')->nullable();
            $table->string('choose4_btn_text')->nullable();
            $table->string('guarantee_heading')->nullable();
            $table->string('guarantee1_heading')->nullable();
            $table->text('guarantee1_content')->nullable();
            $table->string('guarantee2_heading')->nullable();
            $table->text('guarantee2_content')->nullable();
            $table->string('guarantee3_heading')->nullable();
            $table->text('guarantee3_content')->nullable();
            $table->string('guarantee4_heading')->nullable();
            $table->text('guarantee4_content')->nullable();
            $table->string('guarantee5_heading')->nullable();
            $table->text('guarantee5_content')->nullable();
            $table->string('guarantee6_heading')->nullable();
            $table->text('guarantee6_content')->nullable();
            $table->string('guarantee_btn_text')->nullable();
            $table->string('exam_type_heading')->nullable();
            $table->string('exam_type1_heading')->nullable();
            $table->text('exam_type1_content')->nullable();
            $table->string('exam_type2_heading')->nullable();
            $table->text('exam_type2_content')->nullable();
            $table->string('last_heading')->nullable();
            $table->string('last_btn_text')->nullable();
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
        Schema::dropIfExists('online_exams');
    }
}
