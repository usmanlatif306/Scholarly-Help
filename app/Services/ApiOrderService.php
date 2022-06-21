<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiOrderService
{

    public function changeOrderStatus($data)
    {
        $url = env('API_URL') . 'order/status';
        $response = Http::post($url, $data);
        $response = $response->json();
        return $response;
    }

    // posting comment
    public function comment($data)
    {
        $url = env('API_URL') . 'order/comment';
        $response = Http::post($url, $data);
        $response = $response->json();
        return $response;
    }
}
