@extends('layouts.app')

@section('title', 'تسجيل الدخول - إتصال برو')

@section('content')
<div class="w-full max-w-md mx-auto animate-slide-up">
    
    <div class="glass-panel p-8 sm:p-10 rounded-[2.5rem] relative overflow-hidden shadow-2xl shadow-brand-cyan/10">
        <!-- Glow effect -->
        <div class="absolute -top-20 -right-20 w-48 h-48 bg-brand-cyan/20 blur-[60px] rounded-full"></div>
        <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-brand-purple/20 blur-[60px] rounded-full"></div>

        <div class="relative z-10 text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-brand-cyan/20 to-brand-purple/20 border border-white/10 text-white mb-6 backdrop-blur-md shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold tracking-tight">تسجيل الدخول</h2>
            <p class="text-white/60 mt-3 text-sm leading-relaxed">الرجاء إدخال رقم البطاقة الخاصة بك للاستمتاع بالإنترنت</p>
        </div>

        @if($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition class="bg-red-500/10 border border-red-500/20 text-red-200 px-5 py-4 rounded-2xl mb-8 text-sm flex items-start gap-3 backdrop-blur-md relative z-10">
            <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('hotspot.authenticate') }}" method="POST" class="space-y-8 relative z-10" x-data="{ isSubmitting: false, cardNumber: '' }" @submit="isSubmitting = true">
            @csrf
            
            <input type="hidden" name="mac" value="{{ $mac }}">
            <input type="hidden" name="ip" value="{{ $ip }}">
            <input type="hidden" name="link_login_only" value="{{ $link_login_only }}">

            <div class="relative">
                <input type="text" id="card_number" name="card_number" required autofocus autocomplete="off"
                    class="glass-input w-full px-5 py-4 rounded-2xl text-xl text-center font-bold tracking-[0.2em] placeholder-white/20"
                    placeholder="XXXX-XXXX"
                    x-model="cardNumber"
                    @input="cardNumber = cardNumber.toUpperCase()">
                
                <!-- Input focus glow -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-brand-cyan to-brand-purple rounded-2xl blur opacity-0 transition duration-500 group-hover:opacity-20" :class="{'opacity-20': document.activeElement === $refs.input}"></div>
            </div>

            <button type="submit" 
                class="w-full relative group overflow-hidden bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/10 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center gap-2"
                :class="isSubmitting || !cardNumber ? 'opacity-50 cursor-not-allowed' : 'shadow-lg shadow-brand-cyan/20'"
                :disabled="isSubmitting || !cardNumber">
                
                <!-- Button gradient background that slides in -->
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-brand-cyan via-brand-purple to-brand-pink opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <span x-show="!isSubmitting" class="relative z-10 flex items-center gap-2">
                    اتصال بالشبكة
                    <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
                
                <span x-show="isSubmitting" x-cloak class="relative z-10 flex items-center gap-2">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    جاري التحقق...
                </span>
            </button>
            
            <div class="text-center pt-2">
                <a href="{{ route('store.index') }}" class="text-sm text-white/50 hover:text-white transition-colors border-b border-transparent hover:border-white pb-0.5">
                    لا تملك بطاقة؟ تصفح نقاط البيع
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
