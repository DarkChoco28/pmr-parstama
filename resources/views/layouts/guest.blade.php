<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PMR PARSTAMA') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Sansita', Georgia, serif, -apple-system, sans-serif;
            background: #0A0A0A; color: #E0E0E0;
            min-height: 100vh; overflow-x: hidden;
        }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes rotateY3D { 0% { transform: perspective(800px) rotateY(0deg); } 100% { transform: perspective(800px) rotateY(360deg); } }
        @keyframes float3D {
            0%, 100% { transform: perspective(600px) rotateX(15deg) rotateY(-10deg) translateY(0px); }
            50% { transform: perspective(600px) rotateX(-10deg) rotateY(15deg) translateY(-20px); }
        }
        @keyframes morphBlob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 50% 60% 30% 60% / 30% 60% 70% 40%; }
        }
        @keyframes navGlowPulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.3); opacity: 1; }
        }
        @keyframes navCrossFloat1 {
            0%, 100% { transform: perspective(400px) rotateY(0deg) rotateX(0deg) translateY(0px); }
            50% { transform: perspective(400px) rotateY(180deg) rotateX(20deg) translateY(-8px); }
        }
        @keyframes navCrossFloat2 {
            0%, 100% { transform: perspective(400px) rotateY(180deg) rotateX(-15deg) translateY(0px); }
            50% { transform: perspective(400px) rotateY(360deg) rotateX(15deg) translateY(-6px); }
        }
        @keyframes crossFloatBg1 {
            0%, 100% { transform: perspective(800px) rotateY(0deg) rotateX(10deg) translateZ(0px) translateY(0px); }
            50% { transform: perspective(800px) rotateY(180deg) rotateX(-10deg) translateZ(40px) translateY(-30px); }
        }
        @keyframes crossFloatBg2 {
            0%, 100% { transform: perspective(800px) rotateY(180deg) rotateX(-15deg) translateZ(0px) translateY(0px); }
            50% { transform: perspective(800px) rotateY(360deg) rotateX(15deg) translateZ(50px) translateY(-20px); }
        }

        .bg-scene { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .bg-scene::before {
            content: ''; position: absolute; width: 500px; height: 500px; top: -100px; right: -100px;
            background: radial-gradient(circle, rgba(220,38,38,.06) 0%, transparent 70%);
            animation: morphBlob 15s ease-in-out infinite;
        }
        .bg-scene::after {
            content: ''; position: absolute; width: 400px; height: 400px; bottom: -100px; left: -100px;
            background: radial-gradient(circle, rgba(220,38,38,.04) 0%, transparent 70%);
            animation: float3D 12s ease-in-out infinite;
        }
        /* 3D floating Red Cross symbols in background */
        .bg-cross-3d {
            position: fixed; pointer-events: none; z-index: 0; opacity: 0.06;
            will-change: transform;
        }
        .bg-cross-3d svg { width: 100%; height: 100%; }
        .bg-cross-3d:nth-child(1) { width: 40px; height: 40px; top: 20%; left: 10%; animation: crossFloatBg1 12s ease-in-out infinite; }
        .bg-cross-3d:nth-child(2) { width: 28px; height: 28px; top: 60%; left: 85%; animation: crossFloatBg2 14s ease-in-out infinite 2s; }
        .bg-cross-3d:nth-child(3) { width: 50px; height: 50px; top: 75%; left: 15%; animation: crossFloatBg1 16s ease-in-out infinite 1s; }
        .bg-cross-3d:nth-child(4) { width: 22px; height: 22px; top: 15%; left: 80%; animation: crossFloatBg2 10s ease-in-out infinite .5s; }

        nav.auth-nav {
            display: flex; align-items: center; justify-content: center; gap: 16px;
            padding: 20px; background: rgba(10,10,10,.9); backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,.06); position: relative; z-index: 10;
        }
        /* 3D floating Red Cross symbols in navbar */
        .nav-3d-crosses {
            position: absolute; inset: 0; overflow: hidden; pointer-events: none;
            perspective: 600px;
        }
        .nav-3d-cross {
            position: absolute; width: 12px; height: 12px; opacity: 0.08;
            will-change: transform;
        }
        .nav-3d-cross svg { width: 100%; height: 100%; }
        .nav-3d-cross:nth-child(1) { top: 50%; left: 20%; animation: navCrossFloat1 8s ease-in-out infinite; }
        .nav-3d-cross:nth-child(2) { top: 30%; left: 45%; animation: navCrossFloat2 10s ease-in-out infinite 1s; }
        .nav-3d-cross:nth-child(3) { top: 60%; left: 70%; animation: navCrossFloat1 9s ease-in-out infinite 2s; }
        .nav-3d-cross:nth-child(4) { top: 40%; left: 85%; animation: navCrossFloat2 11s ease-in-out infinite .5s; }
        .auth-nav .brand-link { text-decoration: none; display: flex; align-items: center; gap: 10px; position: relative; z-index: 1; }
        .nav-logo-wrap {
            width: 72px; height: 72px; position: relative;
            display: flex; align-items: center; justify-content: center;
        }
        .nav-logo-wrap img {
            width: 100%; height: 100%; object-fit: contain;
        }
        .auth-nav .brand { font-family: 'Sansita', Georgia, serif; font-weight: 700; font-size: 20px; background: linear-gradient(90deg,#EF4444,#DC2626); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .auth-nav .sep { color: rgba(255,255,255,.1); font-weight: 300; }
        .auth-nav .page-title { color: #888; font-weight: 500; font-size: 16px; }

        .auth-page { display: flex; align-items: center; justify-content: center; min-height: calc(100vh - 76px); padding: 36px 16px; position: relative; z-index: 1; }
        .auth-card { width: 100%; max-width: 440px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px; box-shadow: 0 20px 60px rgba(0,0,0,.5); animation: fadeUp .6s ease both; }
        .auth-header { text-align: center; padding: 36px 36px 0; }
        .auth-header img { height: 72px; margin-bottom: 16px; filter: drop-shadow(0 0 12px rgba(220,38,38,.3)); }
        .auth-header h1 { font-family: 'Sansita', Georgia, serif; font-size: 21.6px; font-weight: 700; color: #fff; }
        .auth-header p { color: #888; font-size: 14.4px; margin-top: 4px; }
        .auth-body { padding: 28px 36px 36px; }
        .auth-footer { text-align: center; padding: 20px 36px 28px; border-top: 1px solid rgba(255,255,255,.04); color: #444; font-size: 12.6px; }
        .auth-footer a { color: #EF4444; text-decoration: none; } .auth-footer a:hover { text-decoration: underline; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="bg-scene"></div>
    {{-- 3D floating Red Cross symbols in background --}}
    <div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
    <div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
    <div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
    <div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
    @if(isset($title))
        <nav class="auth-nav">
            {{-- 3D floating Red Cross symbols in navbar --}}
            <div class="nav-3d-crosses">
                <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
                <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
                <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
                <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            </div>
            <a href="{{ route('home') }}" class="brand-link">
                <div class="nav-logo-wrap">
                    <img src="{{ asset('parstama_logo.png') }}" alt="PMR">
                </div>
                <span class="brand">PMR PARSTAMA</span>
            </a>
            <span class="sep">|</span>
            <span class="page-title">{{ $title }}</span>
        </nav>
    @endif
    <main class="auth-page">
        <div class="auth-card">
            @if(isset($header))
                <div class="auth-header">{{ $header }}</div>
            @endif
            <div class="auth-body">{{ $slot }}</div>
        </div>
    </main>
    <div class="auth-footer">&copy; {{ date('Y') }} <a href="{{ route('home') }}">PMR PARSTAMA</a>. Semua hak cipta dilindungi.</div>
    @stack('scripts')
</body>
</html>
