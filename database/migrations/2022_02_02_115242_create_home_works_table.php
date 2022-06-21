<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_works', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading')->nullable();
            $table->string('top_content')->nullable();
            $table->string('section1_heading')->nullable();
            $table->text('section1_content')->nullable();
            $table->string('choose1_heading')->nullable();
            $table->text('choose1_content')->nullable();
            $table->string('choose2_heading')->nullable();
            $table->text('choose2_content')->nullable();
            $table->string('choose3_heading')->nullable();
            $table->text('choose3_content')->nullable();
            $table->string('choose4_heading')->nullable();
            $table->text('choose4_content')->nullable();
            $table->string('choose_btn_text')->nullable();
            $table->string('guarantee_heading')->nullable();
            $table->string('guarantee_sub_heading')->nullable();
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
            $table->string('guarantee7_heading')->nullable();
            $table->text('guarantee7_content')->nullable();
            $table->string('service_heading')->nullable();
            $table->text('service_content')->nullable();
            $table->string('service1_heading')->nullable();
            $table->longText('service1_content')->nullable();
            $table->string('service2_heading')->nullable();
            $table->longText('service2_content')->nullable();
            $table->string('service3_heading')->nullable();
            $table->longText('service3_content')->nullable();
            $table->string('service4_heading')->nullable();
            $table->longText('service4_content')->nullable();
            $table->string('service_btn_text')->nullable();
            $table->string('expert_heading')->nullable();
            $table->text('expert_content')->nullable();
            $table->string('work_heading')->nullable();
            $table->string('work_step1_heading')->nullable();
            $table->text('work_step1_content')->nullable();
            $table->string('work_step2_heading')->nullable();
            $table->text('work_step2_content')->nullable();
            $table->string('work_step3_heading')->nullable();
            $table->text('work_step3_content')->nullable();
            $table->string('subject_heading')->nullable();
            $table->string('homework_heading')->nullable();
            $table->string('homework_content')->nullable();
            $table->string('homework1_heading')->nullable();
            $table->string('homework1_content')->nullable();
            $table->string('homework2_heading')->nullable();
            $table->string('homework2_content')->nullable();
            $table->string('homework3_heading')->nullable();
            $table->string('homework3_content')->nullable();
            $table->string('homework4_heading')->nullable();
            $table->string('homework4_content')->nullable();
            $table->string('homework5_heading')->nullable();
            $table->string('homework5_content')->nullable();
            $table->string('homework6_heading')->nullable();
            $table->string('homework6_content')->nullable();
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
        Schema::dropIfExists('home_works');
    }
}
