<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $input = $request->except(['_token', '_method']);

        foreach ($input as $key => $value) {
            // Skip file inputs handled separately below if not present in this loop logic
            // But usually file inputs are in $request->files, not $input from except
        }

        // Handle specific text inputs
        $settingsToUpdate = [
            'site_name', 'site_description', 'footer_text'
        ];

        foreach ($settingsToUpdate as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        // Handle Logo Upload
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $filename, 'type' => 'image']
            );
        }

        // Handle Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);

            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => $filename, 'type' => 'image']
            );
        }

        // Log Activity
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated system settings',
            'model' => 'Setting',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Clear cache so changes are reflected immediately
        \Illuminate\Support\Facades\Cache::forget('app_settings');

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
