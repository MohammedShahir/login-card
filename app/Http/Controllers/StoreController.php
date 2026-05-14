<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use App\Models\InternetPlan;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $resellers = Reseller::where('is_active', true)->get();
        $plans = InternetPlan::all();

        return view('store.index', compact('resellers', 'plans'));
    }
}
