<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading')->nullable();
            $table->string('top_content')->nullable();
            $table->string('choose1_heading')->nullable();
            $table->text('choose1_content')->nullable();
            $table->string('choose2_heading')->nullable();
            $table->text('choose2_content')->nullable();
            $table->longText('we_are_best')->nullable();
            $table->string('we_are_best_btn')->nullable();
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
            $table->string('guarantee7_heading')->nullable();
            $table->text('guarantee7_content')->nullable();
            $table->string('guarantee8_heading')->nullable();
            $table->text('guarantee8_content')->nullable();
            $table->string('guarantee9_heading')->nullable();
            $table->text('guarantee9_content')->nullable();
            $table->string('guarantee10_heading')->nullable();
            $table->text('guarantee10_content')->nullable();
            $table->string('guarantee11_heading')->nullable();
            $table->text('guarantee11_content')->nullable();
            $table->string('guarantee12_heading')->nullable();
            $table->text('guarantee12_content')->nullable();
            $table->string('guarantee13_heading')->nullable();
            $table->text('guarantee13_content')->nullable();
            $table->string('features')->nullable();
            $table->string('features_btn')->nullable();
            $table->string('expert_heading')->nullable();
            $table->text('expert_content')->nullable();
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
            $table->text('assignment_type')->nullable();
            $table->string('subject_heading')->nullable();
            $table->string('subject_sub_heading')->nullable();
            $table->string('subject_btn')->nullable();
            $table->string('past_work_heading')->nullable();
            $table->text('past_work_content')->nullable();
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
        Schema::dropIfExists('assignments');
    }
}
