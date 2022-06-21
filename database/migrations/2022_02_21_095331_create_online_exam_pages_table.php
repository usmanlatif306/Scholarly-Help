<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineExamPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_exam_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('top_heading');
            $table->string('top_content');
            $table->text('main_content')->nullable();
            $table->string('top_btn')->nullable();
            $table->string('qualtity_heading')->nullable();
            $table->text('qualtity_content')->nullable();
            $table->string('qualtity_heading_1')->nullable();
            $table->text('qualtity_about_1')->nullable();
            $table->string('qualtity_heading_2')->nullable();
            $table->text('qualtity_about_2')->nullable();
            $table->string('qualtity_heading_3')->nullable();
            $table->text('qualtity_about_3')->nullable();
            $table->string('qualtity_heading_4')->nullable();
            $table->text('qualtity_about_4')->nullable();
            $table->string('qualtity_heading_5')->nullable();
            $table->text('qualtity_about_5')->nullable();
            $table->string('qualtity_heading_6')->nullable();
            $table->text('qualtity_about_6')->nullable();
            $table->string('how_work_heading')->nullable();
            $table->text('how_work_content')->nullable();
            $table->string('how_work_step_1')->nullable();
            $table->text('how_work_step_1_process')->nullable();
            $table->string('how_work_step_2')->nullable();
            $table->text('how_work_step_2_process')->nullable();
            $table->string('how_work_step_3')->nullable();
            $table->text('how_work_step_3_process')->nullable();
            $table->string('how_work_step_4')->nullable();
            $table->text('how_work_step_4_process')->nullable();
            $table->string('work_cta_btn')->nullable();
            $table->string('subject_discipline_heading')->nullable();
            $table->text('subject_discipline_content')->nullable();
            $table->string('subject_faq_heading')->nullable();
            $table->text('subject_faq_about')->nullable();
            $table->string('subject_cta_btn')->nullable();
            $table->string('subject_specialist_heading')->nullable();
            $table->text('subject_specialist_content')->nullable();
            $table->string('subject_testimonial_heading')->nullable();
            $table->text('subject_testimonial_about')->nullable();
            $table->string('academic_service_heading')->nullable();
            $table->text('academic_service_about')->nullable();
            $table->string('academic_service_1_heading')->nullable();
            $table->text('academic_service_1_about')->nullable();
            $table->string('academic_service_2_heading')->nullable();
            $table->text('academic_service_2_about')->nullable();
            $table->string('academic_service_3_heading')->nullable();
            $table->text('academic_service_3_about')->nullable();
            $table->string('cta_btn_heading')->nullable();
            $table->string('cta_btn_content')->nullable();
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
        Schema::dropIfExists('online_exam_pages');
    }
}
