<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil – PMR PARSTAMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Sansita', Georgia, serif, sans-serif;
            background: #0f0f0f; color: #f0f0f0;
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding: 2rem;
            overflow: hidden;
        }

        @keyframes pop {
            0%   { transform: scale(0.4); opacity: 0; }
            70%  { transform: scale(1.12); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes ripple {
            0%   { transform: scale(1); opacity: .6; }
            100% { transform: scale(3.5); opacity: 0; }
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        @keyframes navLogoFloat3D {
            0%, 100% { transform: perspective(400px) rotateY(-12deg) rotateX(5deg) translateY(0px); }
            25% { transform: perspective(400px) rotateY(0deg) rotateX(-5deg) translateY(-3px); }
            50% { transform: perspective(400px) rotateY(12deg) rotateX(5deg) translateY(0px); }
            75% { transform: perspective(400px) rotateY(0deg) rotateX(-5deg) translateY(-3px); }
        }
        @keyframes navGlowPulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.3); opacity: 1; }
        }
        @keyframes crossFloatBg1 {
            0%, 100% { transform: perspective(800px) rotateY(0deg) rotateX(10deg) translateZ(0px) translateY(0px); }
            50% { transform: perspective(800px) rotateY(180deg) rotateX(-10deg) translateZ(40px) translateY(-30px); }
        }
        @keyframes crossFloatBg2 {
            0%, 100% { transform: perspective(800px) rotateY(180deg) rotateX(-15deg) translateZ(0px) translateY(0px); }
            50% { transform: perspective(800px) rotateY(360deg) rotateX(15deg) translateZ(50px) translateY(-20px); }
        }
        @keyframes successIcon3D {
            0%, 100% { transform: perspective(600px) rotateY(-15deg) rotateX(5deg); }
            50% { transform: perspective(600px) rotateY(15deg) rotateX(-5deg); }
        }

        /* 3D floating Red Cross symbols */
        .bg-cross-3d {
            position: fixed; pointer-events: none; z-index: 0; opacity: 0.06;
            will-change: transform;
        }
        .bg-cross-3d svg { width: 100%; height: 100%; }
        .bg-cross-3d:nth-child(1) { width: 40px; height: 40px; top: 20%; left: 10%; animation: crossFloatBg1 12s ease-in-out infinite; }
        .bg-cross-3d:nth-child(2) { width: 28px; height: 28px; top: 60%; left: 85%; animation: crossFloatBg2 14s ease-in-out infinite 2s; }
        .bg-cross-3d:nth-child(3) { width: 50px; height: 50px; top: 75%; left: 15%; animation: crossFloatBg1 16s ease-in-out infinite 1s; }
        .bg-cross-3d:nth-child(4) { width: 22px; height: 22px; top: 15%; left: 80%; animation: crossFloatBg2 10s ease-in-out infinite .5s; }

        /* PMR Logo 3D in navbar area */
        .pmr-logo-3d-wrap {
            display: inline-flex; align-items: center; gap: 10px; margin-bottom: 1rem;
            text-decoration: none;
        }
        .pmr-logo-3d {
            width: 80px; height: 80px; object-fit: contain;
        }

        /* BACKGROUND */
        .bg-circle {
            position: fixed; border-radius: 50%; pointer-events: none;
            background: radial-gradient(circle, rgba(220,38,38,.12) 0%, transparent 70%);
        }
        .bg-circle-1 { width: 600px; height: 600px; top:-100px; left:-100px; }
        .bg-circle-2 { width: 400px; height: 400px; bottom:-80px; right:-80px; }

        /* ICON */
        .success-icon-wrap {
            position: relative; display: inline-flex;
            align-items: center; justify-content: center;
            margin-bottom: 2rem;
            animation: float 3s ease-in-out infinite, successIcon3D 8s ease-in-out infinite;
        }
        .ripple {
            position: absolute; width: 100%; height: 100%; border-radius: 50%;
            border: 2px solid rgba(220,38,38,.5);
            animation: ripple 2s ease-out infinite;
        }
        .ripple:nth-child(2) { animation-delay: .6s; }
        .ripple:nth-child(3) { animation-delay: 1.2s; }
        .success-icon {
            width: 96px; height: 96px; border-radius: 50%;
            background: linear-gradient(135deg,#dc2626,#991b1b);
            display: flex; align-items: center; justify-content: center;
            font-size: 2.8rem;
            box-shadow: 0 0 40px rgba(220,38,38,.4);
            animation: pop .6s .2s cubic-bezier(.175,.885,.32,1.275) both;
            position: relative; z-index: 1;
        }

        /* TEXT */
        h1 {
            font-size: clamp(1.8rem,5vw,2.8rem); font-weight: 800;
            margin-bottom: .75rem;
            animation: fadeUp .6s .5s ease both;
        }
        h1 span {
            background: linear-gradient(90deg,#ef4444,#f97316,#ef4444);
            background-size: 200% auto;
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientShift 3s linear infinite;
        }
        .sub {
            color: #71717a; font-size: 1rem; max-width: 440px;
            line-height: 1.7; margin: 0 auto 2.5rem;
            animation: fadeUp .6s .65s ease both;
        }

        /* INFO CARD */
        .info-card {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 16px; padding: 1.5rem 2rem;
            margin-bottom: 2.5rem; max-width: 440px; width: 100%;
            animation: fadeUp .6s .8s ease both;
        }
        .info-row {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem 0; border-bottom: 1px solid rgba(255,255,255,.05);
            font-size: .88rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-icon { font-size: 1.1rem; flex-shrink: 0; }
        .info-text { color: #a1a1aa; text-align: left; }
        .info-text strong { color: #f0f0f0; display: block; font-size: .8rem; margin-bottom: .1rem; }

        /* BUTTONS */
        .actions {
            display: flex; flex-wrap: wrap; gap: 1rem;
            justify-content: center;
            animation: fadeUp .6s .95s ease both;
        }
        .btn-primary {
            background: linear-gradient(135deg,#dc2626,#991b1b);
            color: #fff; font-weight: 700; padding: .85rem 2rem;
            border-radius: 50px; text-decoration: none; font-size: .95rem;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(220,38,38,.3);
        }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(220,38,38,.45); }
        .btn-outline {
            background: transparent; color: #e4e4e7;
            border: 1.5px solid rgba(255,255,255,.15);
            font-weight: 600; padding: .85rem 2rem;
            border-radius: 50px; text-decoration: none; font-size: .95rem;
            transition: border-color .2s, color .2s, transform .2s;
        }
        .btn-outline:hover { border-color: #ef4444; color: #ef4444; transform: translateY(-3px); }

        /* CONFETTI dots */
        .dot {
            position: fixed; border-radius: 50%; pointer-events: none;
            animation: floatDot linear infinite;
        }
        @keyframes floatDot {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>

<div class="bg-circle bg-circle-1"></div>
<div class="bg-circle bg-circle-2"></div>

{{-- 3D floating Red Cross symbols --}}
<div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
<div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
<div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
<div class="bg-cross-3d"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>

{{-- 3D PMR Logo --}}
<a href="{{ url('/') }}" class="pmr-logo-3d-wrap">
    <img src="{{ asset('parstama_logo.png') }}" alt="PMR" class="pmr-logo-3d">
    <span style="font-family: 'Sansita', Georgia, serif; font-weight: 700; font-size: 18px; background: linear-gradient(90deg,#EF4444,#DC2626); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">PMR PARSTAMA</span>
</a>

{{-- CONFETTI --}}
<script>
    const colors = ['#ef4444','#f97316','#fbbf24','#dc2626','#ffffff'];
    for (let i = 0; i < 18; i++) {
        const d = document.createElement('div');
        d.className = 'dot';
        const size = Math.random() * 10 + 5;
        d.style.cssText = `
            width:${size}px; height:${size}px;
            background:${colors[Math.floor(Math.random()*colors.length)]};
            left:${Math.random()*100}%;
            animation-duration:${Math.random()*6+5}s;
            animation-delay:${Math.random()*3}s;
            opacity:.7;
        `;
        document.body.appendChild(d);
    }
</script>

{{-- ICON --}}
<div class="success-icon-wrap">
    <div class="ripple"></div>
    <div class="ripple"></div>
    <div class="ripple"></div>
    <div class="success-icon">🩸</div>
</div>

{{-- TEXT --}}
<h1>Pendaftaran <span>Berhasil!</span></h1>
<p class="sub">
    Terima kasih telah mendaftar sebagai calon anggota <strong>PMR PARSTAMA</strong>.
    Data Anda telah kami terima dan akan segera diproses oleh tim panitia seleksi.
</p>

{{-- INFO CARD --}}
<div class="info-card">
    <div class="info-row">
        <div class="info-icon">📧</div>
        <div class="info-text">
            <strong>Pantau Informasi Panitia</strong>
            Informasi lanjutan dapat disampaikan melalui email atau WhatsApp yang Anda daftarkan.
        </div>
    </div>
    <div class="info-row">
        <div class="info-icon">📅</div>
        <div class="info-text">
            <strong>Proses Seleksi</strong>
            Pendaftaran Anda akan diperiksa oleh panitia sesuai jadwal seleksi yang sedang berjalan.
        </div>
    </div>
    <div class="info-row">
        <div class="info-icon">📢</div>
        <div class="info-text">
            <strong>Cek Status</strong>
            Gunakan fitur cek status untuk melihat perkembangan pendaftaran Anda kapan saja.
        </div>
    </div>
</div>

{{-- BUTTONS --}}
<div class="actions">
    <a href="{{ url('/') }}" class="btn-primary">← Kembali ke Beranda</a>
    <a href="{{ route('registration.status') }}" class="btn-outline">Cek Status Pendaftaran</a>
</div>

</body>
</html>
