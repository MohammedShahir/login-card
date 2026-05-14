@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.users.index') }}" class="w-10 h-10 glass-button rounded-xl flex items-center justify-center hover:text-brand-cyan"><svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h2 class="text-3xl font-bold">تعديل بيانات المشرف: {{ $user->name }}</h2>
    </div>

    @if($errors->any())
        <div class="bg-red-500/20 text-red-200 px-4 py-3 rounded-xl border border-red-500/20 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-6 rounded-3xl border-brand-cyan/20">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">اسم المشرف</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="glass-input w-full px-4 py-2.5 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5 text-white/80">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required dir="ltr" class="glass-input w-full px-4 py-2.5 rounded-xl font-mono text-left">
            </div>
            
            <div class="pt-4 border-t border-white/10 mt-4">
                <p class="text-xs text-brand-pink mb-4">اترك حقول كلمة المرور فارغة إذا لم تكن ترغب في تغييرها.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-white/80">كلمة المرور الجديدة</label>
                        <input type="password" name="password" dir="ltr" class="glass-input w-full px-4 py-2.5 rounded-xl font-mono">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-white/80">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="password_confirmation" dir="ltr" class="glass-input w-full px-4 py-2.5 rounded-xl font-mono">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="glass-button w-full py-3.5 rounded-xl bg-brand-cyan/20 text-brand-cyan font-bold hover:bg-brand-cyan/30 mt-6 shadow-lg shadow-brand-cyan/10">تحديث البيانات</button>
        </form>
    </div>
</div>
@endsection
