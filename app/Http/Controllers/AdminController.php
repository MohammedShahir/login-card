<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use App\Models\InternetPlan;
use App\Models\AuthLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_resellers' => Reseller::count(),
            'total_plans' => InternetPlan::count(),
            'total_auths' => AuthLog::count(),
            'success_auths' => AuthLog::where('status', 'Success')->count(),
        ];

        $recent_logs = AuthLog::orderBy('timestamp', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_logs'));
    }
}
