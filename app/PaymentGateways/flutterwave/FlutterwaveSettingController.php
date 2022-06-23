<?php

namespace App\PaymentGateways\Flutterwave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PaymentGatewaySettingsService;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class FlutterwaveSettingController extends Controller
{

    private $uniqueName = 'flutterwave';

    public function updateSettings(Request $request, PaymentGatewaySettingsService $settingService)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'publishable_key' => 'required',
            'secret_key' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(['gateway' => $this->uniqueName]);
        }

        $keys = [
            'publishable_key' => $request->publishable_key,
            'secret_key' => $request->secret_key,
            'secret_hash' => $request->secret_hash,
        ];
        $settingService->save($this->uniqueName, $request->name, $keys, $request->inactive);

        $env = [
            [
                'key' => 'FLW_PUBLIC_KEY',
                'value' => $request->publishable_key,
            ],
            [
                'key' => 'FLW_SECRET_KEY',
                'value' => $request->secret_key,
            ],
            [
                'key' => 'FLW_SECRET_HASH',
                'value' => $request->secret_hash,
            ]
        ];
        $this->updateEnvKeys($env);

        return redirect()->back()->withSuccess('Successfully updated');
    }

    // upating env file
    private function updateEnvKeys($keys)
    {
        DotenvEditor::setKeys($keys);
        DotenvEditor::save();

        Artisan::call("cache:clear");
        Artisan::call("config:clear");
    }
}
