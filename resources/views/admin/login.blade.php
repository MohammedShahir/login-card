@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 relative">
    <div class="glass-panel max-w-md w-full p-8 md:p-10 rounded-3xl relative overflow-hidden group animate-slide-up shadow-2xl">
        <div class="absolute top-[-20%] right-[-20%] w-48 h-48 bg-brand-cyan/20 rounded-full blur-[80px]"></div>
        <div class="absolute bottom-[-20%] left-[-20%] w-48 h-48 bg-brand-purple/20 rounded-full blur-[80px]"></div>
        
        <div class="relative z-10">
            <div class="text-center mb-10">
                <div class="w-16 h-16 mx-auto bg-brand-cyan/10 rounded-2xl flex items-center justify-center mb-6 border border-brand-cyan/20">
                    <svg class="w-8 h-8 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">إدارة النظام</h1>
                <p class="text-white/60 text-sm">قم بتسجيل الدخول للوصول إلى لوحة التحكم</p>
            </div>

            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/30 text-red-300 text-sm p-3 rounded-xl mb-6 text-center animate-fade-in">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-white/80">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" required dir="ltr" class="glass-input w-full px-4 py-3 rounded-xl focus:ring-brand-cyan transition font-mono">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-white/80">كلمة المرور</label>
                    <input type="password" name="password" required dir="ltr" class="glass-input w-full px-4 py-3 rounded-xl focus:ring-brand-cyan transition font-mono">
                </div>
                
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 text-brand-cyan focus:ring-brand-cyan">
                    <label for="remember" class="text-sm text-white/70">تذكرني</label>
                </div>

                <button type="submit" class="glass-button w-full py-3.5 rounded-xl bg-brand-cyan/20 text-brand-cyan font-bold hover:bg-brand-cyan/30 mt-6 shadow-lg shadow-brand-cyan/10">تسجيل الدخول</button>
            </form>
            
            <div class="mt-8 text-center">
                <a href="{{ route('store.index') }}" class="text-white/40 hover:text-white/80 text-sm transition-colors">العودة للصفحة الرئيسية</a>
            </div>
        </div>
    </div>
</div>
@endsection
