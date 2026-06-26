<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { background: #0A0A0A !important; color: #E0E0E0 !important; }
            .bg-gray-100 { background: #0A0A0A !important; }
            /* 3D floating Red Cross symbols in admin background */
            @keyframes adminCrossFloat1 {
                0%, 100% { transform: perspective(800px) rotateY(0deg) rotateX(10deg) translateZ(0px) translateY(0px); }
                50% { transform: perspective(800px) rotateY(180deg) rotateX(-10deg) translateZ(40px) translateY(-30px); }
            }
            @keyframes adminCrossFloat2 {
                0%, 100% { transform: perspective(800px) rotateY(180deg) rotateX(-15deg) translateZ(0px) translateY(0px); }
                50% { transform: perspective(800px) rotateY(360deg) rotateX(15deg) translateZ(50px) translateY(-20px); }
            }
            .admin-bg-cross {
                position: fixed; pointer-events: none; z-index: 0; opacity: 0.04;
                will-change: transform;
            }
            .admin-bg-cross svg { width: 100%; height: 100%; }
            .admin-bg-cross:nth-child(1) { width: 40px; height: 40px; top: 20%; left: 8%; animation: adminCrossFloat1 12s ease-in-out infinite; }
            .admin-bg-cross:nth-child(2) { width: 28px; height: 28px; top: 60%; left: 85%; animation: adminCrossFloat2 14s ease-in-out infinite 2s; }
            .admin-bg-cross:nth-child(3) { width: 50px; height: 50px; top: 75%; left: 12%; animation: adminCrossFloat1 16s ease-in-out infinite 1s; }
            .admin-bg-cross:nth-child(4) { width: 22px; height: 22px; top: 15%; left: 80%; animation: adminCrossFloat2 10s ease-in-out infinite .5s; }
        </style>
    </head>
    <body class="font-sans antialiased" style="background:#0A0A0A;color:#E0E0E0;">
        {{-- 3D floating Red Cross symbols in background --}}
        <div class="admin-bg-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="admin-bg-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="admin-bg-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="admin-bg-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="min-h-screen" style="background:#0A0A0A; position: relative; z-index: 1;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header style="background:rgba(255,255,255,.03);border-bottom:1px solid rgba(255,255,255,.06);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
