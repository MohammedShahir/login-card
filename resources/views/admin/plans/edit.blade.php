@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.plans.index') }}" class="w-10 h-10 glass-button rounded-xl flex items-center justify-center hover:text-brand-purple"><svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h2 class="text-3xl font-bold">تعديل الباقة: {{ $plan->title }}</h2>
    </div>

    @if($errors->any())
        <div class="bg-red-500/20 text-red-200 px-4 py-3 rounded-xl border border-red-500/20 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-6 rounded-3xl border-brand-purple/20">
        <form action="{{ route('admin.plans.update', $plan) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">اسم الباقة</label>
                <input type="text" name="title" value="{{ old('title', $plan->title) }}" required class="glass-input w-full px-4 py-2.5 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">السعر</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $plan->price) }}" required class="glass-input w-full px-4 py-2.5 rounded-xl">
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-white/80">السعة (جيجابايت)</label>
                    <input type="number" name="data_limit" value="{{ old('data_limit', $plan->data_limit) }}" class="glass-input w-full px-4 py-2.5 rounded-xl">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-white/80">الوقت (بالدقائق)</label>
                    <input type="number" name="time_limit" value="{{ old('time_limit', $plan->time_limit) }}" class="glass-input w-full px-4 py-2.5 rounded-xl">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">تحديد السرعة (MikroTik Rate Limit)</label>
                <input type="text" name="speed_limit" value="{{ old('speed_limit', $plan->speed_limit) }}" dir="ltr" class="glass-input w-full px-4 py-2.5 rounded-xl font-mono">
            </div>
            
            <button type="submit" class="glass-button w-full py-3.5 rounded-xl bg-brand-purple/20 text-brand-purple font-bold hover:bg-brand-purple/30 mt-6 shadow-lg shadow-brand-purple/10">تحديث الباقة</button>
        </form>
    </div>
</div>
@endsection
