<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'إتصال برو')</title>
    
    <!-- PWA Setup -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    <link rel="apple-touch-icon" href="/icon-192x192.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen relative font-sans overflow-x-hidden">
    
    <!-- Ambient Animated Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] bg-brand-cyan/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-[35vw] h-[35vw] bg-brand-purple/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-[-10%] left-[20%] w-[40vw] h-[40vw] bg-brand-pink/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob" style="animation-delay: 4s;"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20"></div>
    </div>

    <!-- Navigation / Header -->
    <nav class="fixed w-full z-50 top-0 glass-panel border-t-0 border-x-0 border-b border-glass-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <svg class="w-8 h-8 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                    <span class="text-xl font-bold tracking-wider text-white">إتصال <span class="text-gradient">برو</span></span>
                </div>
                <div class="flex gap-4">
                    @if(request()->routeIs('store.index'))
                        <a href="{{ route('hotspot.login') }}" class="glass-button px-4 py-2 rounded-full text-sm font-medium hidden sm:block">تسجيل الدخول للشبكة</a>
                    @else
                        <a href="{{ route('store.index') }}" class="glass-button px-4 py-2 rounded-full text-sm font-medium">الباقات والنقاط</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen flex flex-col justify-center">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto py-6 text-center text-white/40 text-sm">
        <p>&copy; {{ date('Y') }} إتصال برو لخدمات الإنترنت المتقدمة.</p>
    </footer>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(registration => {
                    console.log('SW registered: ', registration);
                }).catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
            });
        }
    </script>
</body>
</html>
