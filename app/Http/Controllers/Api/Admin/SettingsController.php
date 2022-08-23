<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::all();

        if (!count($settings))
        {
            $settings = config('defaults.settings');
        }

        return $settings;
    }
}
