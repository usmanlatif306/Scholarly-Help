<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PriceType;
use App\AdditionalService;

class Service extends Model
{
    protected $fillable = [
        'id',
        'name',
        'price_type_id',
        'price',
        'single_spacing_price',
        'double_spacing_price',
        'minimum_order_quantity',
        'inactive',
        'parent'
    ];

    /**
     * The additionalServices that belong to the Service.
     */
    public function additionalServices()
    {
        return $this->belongsToMany('App\AdditionalService', 'service_tag_additional_services');
    }

    /**
     * The sub_categories that belong to the Service.
     */
    public function subCategories()
    {
        return $this->belongsToMany('App\SubCategory', 'service_tag_sub_categories');
    }

    public function price_type()
    {
        return $this->belongsTo('App\PriceType');
    }

    public static function dropdown()
    {
        $data['price_type_list'] = PriceType::pluck('name', 'id')->toArray();
        $data['additional_services_list'] = AdditionalService::pluck('name', 'id')->toArray();
        $data['sab_categories'] = SubCategory::pluck('name', 'id')->toArray();
        return $data;
    }
}
