<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternetPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = InternetPlan::latest()->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'data_limit' => 'nullable|integer',
            'time_limit' => 'nullable|integer',
            'speed_limit' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        InternetPlan::create($data);
        return redirect()->route('admin.plans.index')->with('success', 'تم إضافة الباقة بنجاح');
    }

    public function edit(InternetPlan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, InternetPlan $plan)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'data_limit' => 'nullable|integer',
            'time_limit' => 'nullable|integer',
            'speed_limit' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $plan->update($data);
        return redirect()->route('admin.plans.index')->with('success', 'تم تحديث الباقة بنجاح');
    }

    public function destroy(InternetPlan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'تم حذف الباقة بنجاح');
    }
}
