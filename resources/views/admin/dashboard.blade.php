@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 relative z-10 animate-fade-in">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-bold">لوحة القيادة</h2>
            <p class="text-white/60 mt-1">إحصائيات النظام المباشرة وسجل الدخول</p>
        </div>
        <a href="/" target="_blank" class="glass-button px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 hover:text-brand-cyan">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            عرض الموقع المباشر
        </a>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-panel p-6 rounded-3xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <div class="absolute top-0 right-0 w-24 h-24 bg-brand-cyan/20 blur-2xl group-hover:bg-brand-cyan/30 transition-colors"></div>
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium">إجمالي نقاط البيع</p>
                <div class="flex items-end gap-3 mt-2">
                    <h3 class="text-4xl font-extrabold text-brand-cyan">{{ $stats['total_resellers'] }}</h3>
                    <span class="text-white/40 text-sm mb-1">متجر</span>
                </div>
            </div>
        </div>
        
        <div class="glass-panel p-6 rounded-3xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <div class="absolute top-0 right-0 w-24 h-24 bg-brand-purple/20 blur-2xl group-hover:bg-brand-purple/30 transition-colors"></div>
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium">الباقات المتاحة</p>
                <div class="flex items-end gap-3 mt-2">
                    <h3 class="text-4xl font-extrabold text-brand-purple">{{ $stats['total_plans'] }}</h3>
                    <span class="text-white/40 text-sm mb-1">باقة</span>
                </div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-3xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <div class="absolute top-0 right-0 w-24 h-24 bg-brand-pink/20 blur-2xl group-hover:bg-brand-pink/30 transition-colors"></div>
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium">عمليات تسجيل الدخول</p>
                <div class="flex items-end gap-3 mt-2">
                    <h3 class="text-4xl font-extrabold text-brand-pink">{{ $stats['total_auths'] }}</h3>
                    <span class="text-white/40 text-sm mb-1">عملية</span>
                </div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-3xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-500/20 blur-2xl group-hover:bg-green-500/30 transition-colors"></div>
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium">العمليات الناجحة</p>
                <div class="flex items-end gap-3 mt-2">
                    <h3 class="text-4xl font-extrabold text-green-400">{{ $stats['success_auths'] }}</h3>
                    <span class="text-white/40 text-sm mb-1">عملية</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Logs -->
    <div class="glass-panel rounded-3xl p-6 md:p-8 mt-8 border border-white/10 shadow-2xl">
        <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            أحدث عمليات الدخول
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead>
                    <tr class="text-white/50 border-b border-white/10">
                        <th class="pb-4 px-4 font-medium">رقم البطاقة</th>
                        <th class="pb-4 px-4 font-medium">عنوان الماك (MAC)</th>
                        <th class="pb-4 px-4 font-medium">عنوان الـ IP</th>
                        <th class="pb-4 px-4 font-medium">الحالة</th>
                        <th class="pb-4 px-4 font-medium">الوقت</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($recent_logs as $log)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="py-4 px-4 font-mono font-medium">{{ $log->card_number }}</td>
                        <td class="py-4 px-4 font-mono text-white/60 group-hover:text-white/80 transition-colors">{{ $log->mac_address }}</td>
                        <td class="py-4 px-4 font-mono text-white/60 group-hover:text-white/80 transition-colors">{{ $log->ip_address }}</td>
                        <td class="py-4 px-4">
                            @if($log->status === 'Success')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-500/10 border border-green-500/20 text-green-400 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                    ناجح
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-500/10 border border-red-500/20 text-red-400 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                    مرفوض
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-white/50">{{ \Carbon\Carbon::parse($log->timestamp)->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-white/40">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                لا توجد سجلات مصادقة حتى الآن.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
