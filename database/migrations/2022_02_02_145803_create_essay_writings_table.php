<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssayWritingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_writings', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading')->nullable();
            $table->string('top_content')->nullable();
            $table->text('section_content')->nullable();
            $table->string('section1_heading')->nullable();
            $table->text('section1_content')->nullable();
            $table->string('choose1_heading')->nullable();
            $table->text('choose1_content')->nullable();
            $table->string('choose2_heading')->nullable();
            $table->text('choose2_content')->nullable();
            $table->string('choose3_heading')->nullable();
            $table->text('choose3_content')->nullable();
            $table->string('choose4_heading')->nullable();
            $table->text('choose5_content')->nullable();
            $table->string('choose5_heading')->nullable();
            $table->text('choose6_content')->nullable();
            $table->string('choose6_heading')->nullable();
            $table->text('choose4_content')->nullable();
            $table->string('section_btn')->nullable();
            $table->string('work_heading')->nullable();
            $table->string('work_step1_heading')->nullable();
            $table->text('work_step1_content')->nullable();
            $table->string('work_step2_heading')->nullable();
            $table->text('work_step2_content')->nullable();
            $table->string('work_step3_heading')->nullable();
            $table->text('work_step3_content')->nullable();
            $table->string('work_step4_heading')->nullable();
            $table->text('work_step4_content')->nullable();
            $table->string('work_btn')->nullable();
            $table->string('guarantee_heading')->nullable();
            $table->string('guarantee_sub_heading')->nullable();
            $table->string('guarantee1_heading')->nullable();
            $table->string('guarantee2_heading')->nullable();
            $table->string('guarantee3_heading')->nullable();
            $table->string('guarantee4_heading')->nullable();
            $table->string('guarantee5_heading')->nullable();
            $table->string('guarantee6_heading')->nullable();
            $table->string('expert_heading')->nullable();
            $table->text('expert_content')->nullable();
            $table->string('essay_type')->nullable();
            $table->string('essay_type_content')->nullable();
            $table->string('essay1')->nullable();
            $table->string('essay2')->nullable();
            $table->string('essay3')->nullable();
            $table->string('essay4')->nullable();
            $table->string('essay5')->nullable();
            $table->string('essay6')->nullable();
            $table->string('essay7')->nullable();
            $table->string('essay8')->nullable();
            $table->string('essay9')->nullable();
            $table->string('essay10')->nullable();
            $table->string('essay11')->nullable();
            $table->string('essay12')->nullable();
            $table->string('essay13')->nullable();
            $table->string('essay14')->nullable();
            $table->string('essay15')->nullable();
            $table->string('essay16')->nullable();
            $table->string('essay17')->nullable();
            $table->string('essay_btn')->nullable();
            $table->string('sample_work_heading')->nullable();
            $table->string('faqs_heading')->nullable();
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
        Schema::dropIfExists('essay_writings');
    }
}
