<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة - إتصال برو</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f172a] text-white min-h-screen font-sans">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 glass-panel border-y-0 border-r-0 border-l border-white/10 hidden md:flex flex-col z-20 relative">
            <div class="p-6 border-b border-white/10">
                <h1 class="text-2xl font-bold text-brand-cyan">إتصال <span class="text-white">برو</span></h1>
                <p class="text-sm text-white/50">لوحة تحكم المشرف</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white/5 border border-white/10 text-white font-medium' : 'hover:bg-white/5 transition text-white/70' }}">نظرة عامة</a>
                <a href="{{ route('admin.resellers.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('admin.resellers.*') ? 'bg-white/5 border border-white/10 text-white font-medium' : 'hover:bg-white/5 transition text-white/70' }}">نقاط البيع</a>
                <a href="{{ route('admin.plans.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('admin.plans.*') ? 'bg-white/5 border border-white/10 text-white font-medium' : 'hover:bg-white/5 transition text-white/70' }}">الباقات</a>
                <a href="{{ route('admin.mikrotik.edit') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('admin.mikrotik.*') ? 'bg-white/5 border border-white/10 text-white font-medium' : 'hover:bg-white/5 transition text-white/70' }}">إعدادات MikroTik</a>
            </nav>
            <div class="p-4 border-t border-white/10 text-xs text-white/40 text-center space-y-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-right px-4 py-2 rounded-xl text-red-400 hover:bg-red-500/10 transition text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        تسجيل الخروج
                    </button>
                </form>
                <div>الإصدار 1.0 (Custom Dashboard)</div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 md:p-10 relative">
            <!-- Background Glow -->
            <div class="absolute top-[-10%] right-[-10%] w-[30vw] h-[30vw] bg-brand-cyan/10 rounded-full blur-[100px] pointer-events-none"></div>
            @yield('content')
        </main>
    </div>
</body>
</html>
