<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'top_heading',
        'top_content',
        'top_section_content',
        'way_1_heading',
        'way_1_content',
        'way_1_email',
        'way_2_heading',
        'way_2_content',
        'way_2_email',
        'way_3_heading',
        'way_3_content',
        'way_3_number',
        'hub_heading',
        'hub_1_heading',
        'hub_1_content',
        'hub_2_heading',
        'hub_2_content',
    ];
    public static function form_elements()
    {
        return [
            'top_heading' => 'input',
            'top_content' => 'input',
            'top_section_content' => 'textarea',
            'way_1_heading' => 'input',
            'way_1_content' => 'textarea',
            'way_1_email' => 'input',
            'way_2_heading' => 'input',
            'way_2_content' => 'textarea',
            'way_2_email' => 'input',
            'way_3_heading' => 'input',
            'way_3_content' => 'textarea',
            'way_3_number' => 'input',
            'hub_heading' => 'input',
            'hub_1_heading' => 'input',
            'hub_1_content' => 'textarea',
            'hub_2_heading' => 'input',
            'hub_2_content' => 'textarea',
        ];
    }
}
