<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MikrotikService;
use App\Models\MikrotikConfig;

class HotspotController extends Controller
{
    protected $mikrotikService;

    public function __construct(MikrotikService $mikrotikService)
    {
        $this->mikrotikService = $mikrotikService;
    }

    public function showLogin(Request $request)
    {
        return view('hotspot.login', [
            'mac' => $request->input('mac'),
            'ip' => $request->input('ip'),
            'link_login_only' => $request->input('link-login-only'),
            'link_orig' => $request->input('link-orig'),
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
            'mac' => 'required|string',
            'ip' => 'required|string',
            'link_login_only' => 'required|url',
        ]);

        $cardNumber = $request->input('card_number');
        $macAddress = $request->input('mac');
        $ipAddress = $request->input('ip');
        $linkLoginOnly = $request->input('link_login_only');

        $config = MikrotikConfig::first();

        if (!$config) {
            return back()->withErrors(['message' => 'خطأ في إعدادات النظام، يرجى مراجعة الإدارة.']);
        }

        if (!$this->mikrotikService->connect($config)) {
            return back()->withErrors(['message' => 'تعذر الاتصال بخادم الشبكة، يرجى المحاولة لاحقاً.']);
        }

        $isValid = $this->mikrotikService->authenticateUser($cardNumber, $macAddress, $ipAddress);
        $this->mikrotikService->disconnect();

        if ($isValid) {
            // Redirect back to MikroTik login endpoint
            $redirectUrl = $linkLoginOnly . '?username=' . urlencode($cardNumber) . '&password=' . urlencode($cardNumber);
            return redirect()->away($redirectUrl);
        }

        return back()->withErrors(['message' => 'رقم البطاقة غير صالح أو منتهي الصلاحية.']);
    }
}
