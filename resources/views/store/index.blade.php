@extends('layouts.app')

@section('title', 'باقات الإنترنت ونقاط البيع')

@section('content')
<div class="w-full space-y-12 sm:space-y-16 animate-slide-up" x-data="{ activeTab: 'plans' }">
    
    <!-- Hero Section -->
    <div class="text-center space-y-4 pt-4 sm:pt-10">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
            إنترنت <span class="text-gradient">أسرع</span>، تغطية <span class="text-gradient">أوسع</span>
        </h1>
        <p class="text-lg text-white/70 max-w-2xl mx-auto px-4">
            اختر الباقة التي تناسب احتياجاتك واعثر على أقرب نقطة بيع للحصول على بطاقتك وتفعيل الإنترنت فوراً.
        </p>
    </div>

    <!-- Toggle Tabs -->
    <div class="flex justify-center px-4">
        <div class="glass-panel p-1 rounded-full flex gap-1 w-full max-w-sm">
            <button @click="activeTab = 'plans'" :class="activeTab === 'plans' ? 'bg-brand-cyan/20 text-white' : 'text-white/60 hover:text-white'" class="flex-1 py-3 rounded-full text-sm font-medium transition-all duration-300">
                الباقات
            </button>
            <button @click="activeTab = 'stores'" :class="activeTab === 'stores' ? 'bg-brand-purple/20 text-white' : 'text-white/60 hover:text-white'" class="flex-1 py-3 rounded-full text-sm font-medium transition-all duration-300">
                نقاط البيع
            </button>
        </div>
    </div>

    <!-- Plans Grid -->
    <div x-show="activeTab === 'plans'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($plans as $plan)
        <div class="glass-panel rounded-3xl p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <!-- decorative gradient -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-cyan/20 blur-[50px] rounded-full group-hover:bg-brand-cyan/40 transition-colors"></div>
            
            <h3 class="text-2xl font-bold mb-2">{{ $plan->title }}</h3>
            <div class="flex items-baseline gap-1 mb-6">
                <span class="text-5xl font-extrabold text-brand-cyan">{{ $plan->price }}</span>
                <span class="text-white/60 text-sm">ريال</span>
            </div>
            
            <ul class="space-y-4 mb-8 relative z-10">
                @if($plan->data_limit)
                <li class="flex items-center gap-3 text-white/80">
                    <div class="w-8 h-8 rounded-full bg-brand-cyan/10 flex items-center justify-center text-brand-cyan">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    سعة بيانات {{ $plan->data_limit }} جيجا
                </li>
                @endif
                @if($plan->time_limit)
                <li class="flex items-center gap-3 text-white/80">
                    <div class="w-8 h-8 rounded-full bg-brand-purple/10 flex items-center justify-center text-brand-purple">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    صلاحية {{ $plan->time_limit }} دقيقة
                </li>
                @endif
                @if($plan->speed_limit)
                <li class="flex items-center gap-3 text-white/80">
                    <div class="w-8 h-8 rounded-full bg-brand-pink/10 flex items-center justify-center text-brand-pink">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    سرعة حتى {{ $plan->speed_limit }}
                </li>
                @endif
            </ul>
        </div>
        @empty
        <div class="col-span-full text-center text-white/50 py-12 glass-panel rounded-3xl">
            لا توجد باقات متاحة حالياً، يرجى المحاولة لاحقاً.
        </div>
        @endforelse
    </div>

    <!-- Stores Directory -->
    <div x-show="activeTab === 'stores'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($resellers as $reseller)
        <div class="glass-panel rounded-3xl p-6 flex flex-col items-center text-center group hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-purple/5 to-transparent"></div>
            
            <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center mb-4 text-brand-cyan relative z-10">
                @if($reseller->logo_path)
                    <img src="{{ Storage::url($reseller->logo_path) }}" alt="{{ $reseller->name }}" class="w-full h-full object-cover rounded-2xl">
                @else
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                @endif
            </div>
            
            <h3 class="text-xl font-bold mb-1 relative z-10">{{ $reseller->name }}</h3>
            <p class="text-sm text-white/60 mb-6 min-h-[40px] relative z-10">{{ $reseller->address }}</p>
            
            <div class="flex gap-3 w-full mt-auto relative z-10">
                @if($reseller->phone_number)
                <a href="tel:{{ $reseller->phone_number }}" class="flex-1 glass-button py-2.5 rounded-xl text-sm font-medium flex items-center justify-center gap-2 hover:text-brand-cyan hover:bg-brand-cyan/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    اتصال
                </a>
                @endif
                @if($reseller->google_maps_url)
                <a href="{{ $reseller->google_maps_url }}" target="_blank" class="flex-1 glass-button py-2.5 rounded-xl text-sm font-medium flex items-center justify-center gap-2 hover:text-brand-purple hover:bg-brand-purple/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    الموقع
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-white/50 py-12 glass-panel rounded-3xl">
            لا توجد نقاط بيع مضافة حالياً.
        </div>
        @endforelse
    </div>

</div>
@endsection
