<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResellerController extends Controller
{
    public function index()
    {
        $resellers = Reseller::latest()->get();
        return view('admin.resellers.index', compact('resellers'));
    }

    public function create()
    {
        return view('admin.resellers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'phone_number' => 'nullable|string',
            'is_active' => 'boolean',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('resellers', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        Reseller::create($data);

        return redirect()->route('admin.resellers.index')->with('success', 'تم إضافة نقطة البيع بنجاح');
    }

    public function edit(Reseller $reseller)
    {
        return view('admin.resellers.edit', compact('reseller'));
    }

    public function update(Request $request, Reseller $reseller)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'phone_number' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            if ($reseller->logo_path) Storage::disk('public')->delete($reseller->logo_path);
            $data['logo_path'] = $request->file('logo')->store('resellers', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $reseller->update($data);

        return redirect()->route('admin.resellers.index')->with('success', 'تم تحديث نقطة البيع بنجاح');
    }

    public function destroy(Reseller $reseller)
    {
        if ($reseller->logo_path) Storage::disk('public')->delete($reseller->logo_path);
        $reseller->delete();
        return redirect()->route('admin.resellers.index')->with('success', 'تم حذف نقطة البيع بنجاح');
    }
}
