@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <h2 class="text-3xl font-bold">إعدادات الاتصال بـ MikroTik</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-3 rounded-xl border border-green-500/20 text-sm">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-500/20 text-red-200 px-4 py-3 rounded-xl border border-red-500/20 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-6 md:p-8 rounded-3xl border-brand-pink/20 shadow-2xl shadow-brand-pink/5">
        <form action="{{ route('admin.mikrotik.update') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5 text-brand-pink/80">اسم المعرف (Identity)</label>
                <input type="text" name="identity_name" value="{{ old('identity_name', $config->identity_name) }}" required class="glass-input w-full px-4 py-2.5 rounded-xl focus:ring-brand-pink">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-brand-pink/80">عنوان الـ IP الخاص بالراوتر (Host IP)</label>
                <input type="text" name="host_ip" value="{{ old('host_ip', $config->host_ip) }}" dir="ltr" required class="glass-input w-full px-4 py-2.5 rounded-xl font-mono focus:ring-brand-pink">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-brand-pink/80">اسم مستخدم الـ API</label>
                <input type="text" name="api_username" value="{{ old('api_username', $config->api_username) }}" dir="ltr" required class="glass-input w-full px-4 py-2.5 rounded-xl font-mono focus:ring-brand-pink">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-brand-pink/80">كلمة المرور (اتركه فارغاً للاحتفاظ بالقديم)</label>
                <input type="password" name="api_password" dir="ltr" placeholder="••••••••" class="glass-input w-full px-4 py-2.5 rounded-xl font-mono focus:ring-brand-pink">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-brand-pink/80">منفذ الـ API (الافتراضي 8728)</label>
                <input type="number" name="api_port" value="{{ old('api_port', $config->api_port ?? 8728) }}" dir="ltr" required class="glass-input w-full px-4 py-2.5 rounded-xl font-mono focus:ring-brand-pink">
            </div>
            <button type="submit" class="glass-button w-full py-3.5 rounded-xl bg-brand-pink/20 text-brand-pink font-bold hover:bg-brand-pink/30 mt-8 shadow-lg shadow-brand-pink/10">حفظ وتحديث الاتصال</button>
        </form>
    </div>
</div>
@endsection
