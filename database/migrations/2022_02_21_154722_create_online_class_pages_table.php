<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineClassPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_class_pages', function (Blueprint $table) {
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
            $table->string('qualtity_heading_7')->nullable();
            $table->text('qualtity_about_7')->nullable();
            $table->string('qualtity_heading_8')->nullable();
            $table->text('qualtity_about_8')->nullable();
            $table->string('qualtity_heading_9')->nullable();
            $table->text('qualtity_about_9')->nullable();
            $table->string('qualtity_heading_10')->nullable();
            $table->text('qualtity_about_10')->nullable();
            $table->string('quality_cta_btn')->nullable();
            $table->text('subject_cover_text')->nullable();
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
            $table->text('subject_cover_area_heading')->nullable();
            $table->string('subject_cover_area_text')->nullable();
            $table->string('subject_specialist_heading')->nullable();
            $table->text('subject_specialist_content')->nullable();
            $table->string('subject_faq_heading')->nullable();
            $table->string('academic_service_heading')->nullable();
            $table->text('academic_service_about')->nullable();
            $table->string('academic_service_1_heading')->nullable();
            $table->text('academic_service_1_about')->nullable();
            $table->string('academic_service_2_heading')->nullable();
            $table->text('academic_service_2_about')->nullable();
            $table->string('academic_service_3_heading')->nullable();
            $table->text('academic_service_3_about')->nullable();
            $table->string('subject_testimonial_heading')->nullable();
            $table->text('subject_testimonial_about')->nullable();
            $table->text('cta_btn_heading')->nullable();
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
        Schema::dropIfExists('online_class_pages');
    }
}
