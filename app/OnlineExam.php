<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineExam extends Model
{
    protected $fillable = [
        'top_heading',
        'top_content',
        'section1_heading',
        'choose1_heading',
        'choose1_content',
        'choose2_heading',
        'choose2_content',
        'choose3_heading',
        'choose3_content',
        'choose4_heading',
        'choose4_content',
        'choose4_btn_text',
        'guarantee_heading',
        'guarantee1_heading',
        'guarantee1_content',
        'guarantee2_heading',
        'guarantee2_content',
        'guarantee3_heading',
        'guarantee3_content',
        'guarantee4_heading',
        'guarantee4_content',
        'guarantee5_heading',
        'guarantee5_content',
        'guarantee6_heading',
        'guarantee6_content',
        'guarantee_btn_text',
        'exam_type_heading',
        'exam_type1_heading',
        'exam_type1_content',
        'exam_type2_heading',
        'exam_type2_content',
        'last_heading',
        'last_btn_text',
    ];

    public static function form_elements()
    {
        return [
            'top_heading' => 'input',
            'top_content' => 'input',
            'section1_heading' => 'input',
            'choose1_heading' => 'input',
            'choose1_content' => 'textarea',
            'choose2_heading' => 'input',
            'choose2_content' => 'textarea',
            'choose3_heading' => 'input',
            'choose3_content' => 'textarea',
            'choose4_heading' => 'input',
            'choose4_content' => 'textarea',
            'choose4_btn_text' => 'input',
            'guarantee_heading' => 'input',
            'guarantee1_heading' => 'input',
            'guarantee1_content' => 'textarea',
            'guarantee2_heading' => 'input',
            'guarantee2_content' => 'textarea',
            'guarantee3_heading' => 'input',
            'guarantee3_content' => 'textarea',
            'guarantee4_heading' => 'input',
            'guarantee4_content' => 'textarea',
            'guarantee5_heading' => 'input',
            'guarantee5_content' => 'textarea',
            'guarantee6_heading' => 'input',
            'guarantee6_content' => 'textarea',
            'guarantee_btn_text' => 'input',
            'exam_type_heading' => 'input',
            'exam_type1_heading' => 'input',
            'exam_type1_content' => 'textarea',
            'exam_type2_heading' => 'input',
            'exam_type2_content' => 'textarea',
            'last_heading' => 'input',
            'last_btn_text' => 'input',
        ];
    }
}
