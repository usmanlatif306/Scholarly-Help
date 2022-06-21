<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->string('top_heading')->nullable();
            $table->text('top_content')->nullable();
            $table->string('section_1_heading')->nullable();
            $table->text('section_1_point_1')->nullable();
            $table->text('section_1_point_2')->nullable();
            $table->text('section_1_point_3')->nullable();
            $table->text('section_1_point_4')->nullable();
            $table->text('section_1_point_5')->nullable();
            $table->string('section_1_btn_text')->nullable();
            $table->string('section_2_heading')->nullable();
            $table->string('choose_1_heading')->nullable();
            $table->text('choose_1_content')->nullable();
            $table->string('choose_2_heading')->nullable();
            $table->text('choose_2_content')->nullable();
            $table->string('choose_3_heading')->nullable();
            $table->text('choose_3_content')->nullable();
            $table->string('choose_4_heading')->nullable();
            $table->text('choose_4_content')->nullable();
            $table->string('choose_5_heading')->nullable();
            $table->text('choose_5_content')->nullable();
            $table->string('choose_6_heading')->nullable();
            $table->text('choose_6_content')->nullable();
            $table->string('choose_7_heading')->nullable();
            $table->text('choose_7_content')->nullable();
            $table->string('choose_btn_text')->nullable();
            $table->string('work_heading')->nullable();
            $table->text('work_content')->nullable();
            $table->string('work_step1_heading')->nullable();
            $table->text('work_step1_content')->nullable();
            $table->string('work_step2_heading')->nullable();
            $table->text('work_step2_content')->nullable();
            $table->string('work_step3_heading')->nullable();
            $table->text('work_step3_content')->nullable();
            $table->string('work_btn_text')->nullable();
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
            $table->string('service5_heading')->nullable();
            $table->longText('service5_content')->nullable();
            $table->string('service_btn_text')->nullable();
            $table->text('last_heading')->nullable();
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
        Schema::dropIfExists('online_classes');
    }
}
