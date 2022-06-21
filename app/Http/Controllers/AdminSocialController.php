<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminSocialController extends Controller
{
    public function index()
    {
        $links =  [
            'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID'),
            'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET'),
            'GOOGLE_REDIRECT_URL' => env('GOOGLE_REDIRECT_URL'),
            // 'FACEBOOK_APP_ID' => env('FACEBOOK_APP_ID'),
            // 'FACEBOOK_APP_SECRET' => env('FACEBOOK_APP_SECRET'),
            // 'FACEBOOK_REDIRECT_URL' => env('FACEBOOK_REDIRECT_URL'),
        ];
        return view('setup.socail_urls', compact('links'));
    }

    public function edit(Request $request)
    {

        $array = $request->all();
        $veriables = array_splice($array, 3);
        foreach ($veriables as $key => $value) {
            $this->set_env($key, $value);
        }
        return redirect()->back();
    }

    /**
     * @param string $key
     * @param string $value
     * @param null $env_path
     */
    private function set_env(string $key, string $value, $env_path = null)
    {
        $value = preg_replace('/\s+/', '', $value); //replace special ch
        $key = strtoupper($key); //force upper for security
        $env = file_get_contents(isset($env_path) ? $env_path : base_path('.env')); //fet .env file
        $env = str_replace("$key=" . env($key), "$key=" . $value, $env); //replace value
        /** Save file eith new content */
        $env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
    }
}
