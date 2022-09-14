<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;
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
            return collect($settings);
        }

        return SettingsResource::collection($settings);
    }

    public function firstSetup()
    {
        $set = new Setting();

        $set->settings = config('defaults.settings');

        $set->save();

        return 'Success';
    }

    public function savePaginationSettings(Request $req)
    {
        $set_pagination = new Setting();

        $per_page = $req->per_page;
        $enabled = $req->enabled;

        $set_pagination->where('id', 1)
        ->update([
            'settings->pagination->per_page' => $per_page,
            'settings->pagination->enabled' => $enabled
        ]);

        return $set_pagination; //отладка
    }
}
