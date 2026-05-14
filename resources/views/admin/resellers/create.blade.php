@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.resellers.index') }}" class="w-10 h-10 glass-button rounded-xl flex items-center justify-center hover:text-brand-cyan"><svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h2 class="text-3xl font-bold">إضافة نقطة بيع</h2>
    </div>
    
    @if($errors->any())
        <div class="bg-red-500/20 text-red-200 px-4 py-3 rounded-xl border border-red-500/20 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-6 rounded-3xl border-brand-cyan/20">
        <form action="{{ route('admin.resellers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">اسم المتجر</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="glass-input w-full px-4 py-2.5 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">العنوان أو الوصف</label>
                <input type="text" name="address" value="{{ old('address') }}" class="glass-input w-full px-4 py-2.5 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">رقم الهاتف (للاتصال السريع)</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="glass-input w-full px-4 py-2.5 rounded-xl" dir="ltr">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">رابط الموقع على خرائط جوجل (Google Maps)</label>
                <input type="url" name="google_maps_url" value="{{ old('google_maps_url') }}" class="glass-input w-full px-4 py-2.5 rounded-xl" dir="ltr" placeholder="https://maps.google.com/...">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">صورة الشعار (اختياري)</label>
                <input type="file" name="logo" class="glass-input w-full px-4 py-2.5 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-cyan/20 file:text-brand-cyan hover:file:bg-brand-cyan/30">
            </div>
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" value="1" checked id="is_active" class="w-5 h-5 rounded border-white/20 bg-white/5 text-brand-cyan focus:ring-brand-cyan">
                <label for="is_active" class="text-sm font-medium">تفعيل المتجر وعرضه للعملاء</label>
            </div>
            <button type="submit" class="glass-button w-full py-3.5 rounded-xl bg-brand-cyan/20 text-brand-cyan font-bold hover:bg-brand-cyan/30 mt-6 shadow-lg shadow-brand-cyan/10">حفظ المتجر</button>
        </form>
    </div>
</div>
@endsection
