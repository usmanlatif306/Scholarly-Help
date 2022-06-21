<?php

namespace App;

use App\Services\PageService;
use Illuminate\Database\Eloquent\Model;
use DateTimeZone;


class Setting extends Model
{

    protected $fillable = [
        'option_key',
        'option_value'
    ];

    public $timestamps = false;

    static function get_list_of_time_zone()
    {
        $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        foreach ($timezone_identifiers as $r) {
            $data[$r] = $r;
        }
        return $data;
    }

    // public static function general_dropdown()
    // {
    //     $data['time_zone'] = self::get_list_of_time_zone();

    //     return $data;
    // }

    public static function currency_dropdown()
    {
        $data['decimal_symbol'] = array(
            '.' => '. (Dot)',
            ',' => ', (Comma)'
        );

        $data['thousand_separator'] = array(
            '.' => '. (Dot)',
            ',' => ', (Comma)'
        );

        $data['list_of_digit_grouping_methods'] = [
            FORMAT_CURRENCY_METHOD_ONE => "10,000,000,000",
            FORMAT_CURRENCY_METHOD_TWO => "10,00,00,00,000",
            FORMAT_CURRENCY_METHOD_THREE => "100,0000,0000"
        ];

        return $data;
    }


    public static function homepage_form_elements()
    {
        return [
            'hero_title_1' => 'input',
            // 'hero_button_text' => 'input',
            'hero_content_1' => 'input',
            // 'hero_image' => 'file',
            'hero_title_2' => 'input',
            'hero_content_2' => 'textarea',
            'hero_title_3' => 'input',
            'hero_content_3' => 'textarea',
            // 'section_3_title' => 'input',
            // 'section_3_sub_title' => 'input',
            'tutors_title' => 'input',
            'guarantee_title' => 'input',
            'how_work_title' => 'input',
            'service_title' => 'input',
            'counter_title' => 'input',
            'counter1_text' => 'input',
            'counter1_value' => 'input',
            'counter1_text' => 'input',
            'counter1_value' => 'input',
            'counter2_text' => 'input',
            'counter2_value' => 'input',
            'counter3_text' => 'input',
            'counter3_value' => 'input',
            'review_title' => 'input',
            'faqs_title' => 'input',
            'how_it_works_step_1' => 'input',
            'how_it_works_step_2' => 'input',
            'how_it_works_step_3' => 'input',
            'how_it_works_step_4' => 'input',
            'how_it_works_step_1_content' => 'textarea',
            'how_it_works_step_2_content' => 'textarea',
            'how_it_works_step_3_content' => 'textarea',
            'how_it_works_step_4_content' => 'textarea',
            'guarantee_content' => 'textarea',
            'how_work_content' => 'textarea',
            // 'section_4_title' => 'input',
            // 'section_4_para_1_title' => 'input',
            // 'section_4_para_1_content' => 'textarea',
            // 'section_4_para_2_title' => 'input',
            // 'section_4_para_2_content' => 'textarea',
            // 'section_4_para_3_title' => 'input',
            // 'section_4_para_3_content' => 'textarea',
            // 'section_4_para_4_title' => 'input',
            // 'section_4_para_4_content' => 'textarea',
            // 'order_page_link_text' => 'input',
            'footer_text' => 'input',
            'company_about' => 'textarea',
        ];
    }

    static function socialNetworks()
    {
        return [
            'facebook' => 'input',
            'twitter' => 'input',
            'instagram' => 'input',
            'linkedin' => 'input',
        ];
    }

    static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

    static function get_setting($key)
    {
        $records = self::where('option_key', $key)->get();

        if ($records->count() > 0) {
            $string = $records->first()->option_value;

            if (is_string($string) && is_array(json_decode($string, true))) {
                return json_decode($string);
            } else {
                return $string;
            }
        }

        return FALSE;
    }

    static function save_settings($data, $auto_load_disabled = NULL)
    {

        foreach ($data as $key => $value) {
            $obj = self::updateOrCreate([
                'option_key' => $key
            ]);
            $obj->option_value = trim($value);
            $obj->auto_load_disabled = $auto_load_disabled;
            $obj->save();
        }
    }

    static function seoInputFields($query = NULL)
    {
        $extra['class'] = OnlineClassPage::select(['name', 'slug'])->get();
        $extra['exam'] = OnlineExamPage::select(['name', 'slug'])->get();
        $extra['homework'] = HomeWorkPage::select(['name', 'slug'])->get();
        $extra['assignment'] = AssignmentPage::select(['name', 'slug'])->get();

        $pages = [
            'home',
            'online_class',
            'online_exam',
            'homework',
            'assignment',
            'essay_writing',
            'contact_us',
            'about_us'

        ];
        foreach ($extra as $key => $page) {
            foreach ($page as $item) {
                $pages[] = $item->slug . '_' . $key;
            }
        }

        $meta_tags = [
            'title',
            'description',
            'keywords'
        ];

        $data = [];

        foreach ($pages as $page) {
            foreach ($meta_tags as $tag) {

                //example output: seo_title_home
                $field = 'seo_' . $tag . '_' . $page;

                switch ($query) {
                    case 'grouped':
                        $data['grouped'][$page][] = $field;
                        break;
                    case 'ungrouped':
                        $data['ungrouped'][] = $field;
                        break;
                    default:
                        $data['grouped'][$page][] = $field;
                        $data['ungrouped'][] = $field;
                        break;
                }
            }
        }

        switch ($query) {
            case 'grouped':
                $fields = $data['grouped'];
                break;
            case 'ungrouped':
                $fields = $data['ungrouped'];
                break;
            default:
                $fields = $data;
                break;
        }

        return $fields;
    }

    static function getSeoFieldsByPage($page)
    {
        $pages = self::seoInputFields('grouped');
        // dd($pages);

        return optional($pages)[$page];
    }

    static function getExtraPage(PageService $pageService)
    {
        return $pageService->pages();
    }
}
