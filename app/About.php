<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'top_heading',
        'top_content',
        'top_section_content',
        'subject_specialist_heading',
        'subject_specialist_content',
        'mission_heading',
        'mission_content',
        'vision_heading',
        'vision_content',
        'email_1',
        'email_2',
        'number',
    ];

    public static function form_elements()
    {
        return [
            'top_heading' => 'input',
            'top_content' => 'input',
            'top_section_content' => 'textarea',
            'subject_specialist_heading' => 'input',
            'subject_specialist_content' => 'textarea',
            'mission_heading' => 'input',
            'mission_content' => 'textarea',
            'vision_heading' => 'input',
            'vision_content' => 'textarea',
            'email_1' => 'input',
            'email_2' => 'input',
            'number' => 'input',
        ];
    }
}
