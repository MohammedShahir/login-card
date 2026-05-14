@extends('layouts.app')

@section('content')
<div class="min-h-[90vh] flex items-center justify-center p-6 relative">
    <div class="glass-panel max-w-lg w-full p-8 md:p-10 rounded-3xl text-center relative overflow-hidden group animate-slide-up shadow-2xl">
        <!-- Glow Effects -->
        <div class="absolute top-[-20%] right-[-20%] w-48 h-48 bg-red-500/20 rounded-full blur-[80px]"></div>
        <div class="absolute bottom-[-20%] left-[-20%] w-48 h-48 bg-brand-pink/20 rounded-full blur-[80px]"></div>
        
        <div class="relative z-10">
            <!-- Icon -->
            <div class="w-24 h-24 mx-auto bg-red-500/10 rounded-full flex items-center justify-center mb-6 border border-red-500/20 shadow-[0_0_50px_rgba(239,68,68,0.2)] animate-pulse">
                <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path><line x1="4" y1="4" x2="20" y2="20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></line></svg>
            </div>
            
            <h1 class="text-3xl font-bold mb-4">أنت غير متصل بالشبكة!</h1>
            <p class="text-white/70 mb-8 text-base leading-relaxed">
                عذراً، لا يمكنك الوصول إلى لوحة تسجيل الدخول مباشرة. هذه الصفحة مخصصة فقط عند اتصالك المباشر بشبكة الواي فاي (Hotspot).
            </p>
            
            <!-- Instructions Box -->
            <div class="bg-black/20 border border-white/10 rounded-2xl p-5 mb-8 backdrop-blur-md">
                <h3 class="text-brand-cyan font-semibold mb-3 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    خطوات التفعيل:
                </h3>
                <ul class="text-white/60 text-sm space-y-3 text-right">
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-cyan/20 text-brand-cyan flex items-center justify-center text-xs font-bold">1</span>
                        <span>افتح إعدادات الواي فاي (Wi-Fi) في هاتفك أو جهازك.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-cyan/20 text-brand-cyan flex items-center justify-center text-xs font-bold">2</span>
                        <span>ابحث عن شبكتنا واتصل بها.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-cyan/20 text-brand-cyan flex items-center justify-center text-xs font-bold">3</span>
                        <span>ستظهر لك شاشة تسجيل الدخول تلقائياً.</span>
                    </li>
                </ul>
            </div>
            
            <a href="{{ route('store.index') }}" class="glass-button block w-full py-3.5 rounded-xl text-white hover:text-brand-cyan transition-all text-sm font-medium">
                تصفح نقاط البيع والباقات
            </a>
        </div>
    </div>
</div>
@endsection
