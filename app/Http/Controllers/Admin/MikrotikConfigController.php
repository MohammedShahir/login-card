<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MikrotikConfig;
use Illuminate\Http\Request;

class MikrotikConfigController extends Controller
{
    public function edit()
    {
        $config = MikrotikConfig::first() ?? new MikrotikConfig();
        return view('admin.mikrotik.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'identity_name' => 'required|string',
            'host_ip' => 'required|string',
            'api_username' => 'required|string',
            'api_password' => 'nullable|string',
            'api_port' => 'required|integer',
        ]);

        $config = MikrotikConfig::first();
        if ($config) {
            if (empty($data['api_password'])) {
                unset($data['api_password']);
            }
            $config->update($data);
        } else {
            MikrotikConfig::create($data);
        }

        return redirect()->route('admin.mikrotik.edit')->with('success', 'تم تحديث إعدادات المايكروتك بنجاح');
    }
}
