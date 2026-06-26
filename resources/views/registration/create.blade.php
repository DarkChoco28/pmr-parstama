<!DOCTYPE html>
   <html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran – PMR PARSTAMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Sansita', Georgia, serif, -apple-system, sans-serif;
            background: #0A0A0A;
            color: #E0E0E0;
            min-height: 100vh;
            font-size: 16.2px;
            line-height: 1.5;
        }

        @keyframes float3D {
            0%, 100% { transform: perspective(600px) rotateX(15deg) rotateY(-10deg) translateY(0px); }
            50% { transform: perspective(600px) rotateX(-10deg) rotateY(15deg) translateY(-20px); }
        }
        @keyframes morphBlob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 50% 60% 30% 60% / 30% 60% 70% 40%; }
        }

        @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes shake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-8px)} 40%{transform:translateX(8px)} 60%{transform:translateX(-4px)} 80%{transform:translateX(4px)} }
        @keyframes spin { to { transform: rotate(360deg); } }
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
        @keyframes navCrossFloat1 {
            0%, 100% { transform: perspective(400px) rotateY(0deg) rotateX(0deg) translateY(0px); }
            50% { transform: perspective(400px) rotateY(180deg) rotateX(20deg) translateY(-8px); }
        }
        @keyframes navCrossFloat2 {
            0%, 100% { transform: perspective(400px) rotateY(180deg) rotateX(-15deg) translateY(0px); }
            50% { transform: perspective(400px) rotateY(360deg) rotateX(15deg) translateY(-6px); }
        }
        /* ===== PALANG MERAH 3D BACKGROUND - FULL UPGRADE ===== */
        @keyframes cross3D_A {
            0%   { transform: perspective(900px) rotateY(0deg)   rotateX(15deg)  rotateZ(0deg)   translateZ(0px)   translateY(0px); opacity: .20; }
            25%  { transform: perspective(900px) rotateY(90deg)  rotateX(-20deg) rotateZ(15deg)  translateZ(60px)  translateY(-25px); opacity: .40; }
            50%  { transform: perspective(900px) rotateY(180deg) rotateX(10deg)  rotateZ(-10deg) translateZ(30px)  translateY(-45px); opacity: .25; }
            75%  { transform: perspective(900px) rotateY(270deg) rotateX(-15deg) rotateZ(20deg)  translateZ(70px)  translateY(-15px); opacity: .45; }
            100% { transform: perspective(900px) rotateY(360deg) rotateX(15deg)  rotateZ(0deg)   translateZ(0px)   translateY(0px); opacity: .20; }
        }
        @keyframes cross3D_B {
            0%   { transform: perspective(700px) rotateY(180deg) rotateX(-12deg) rotateZ(10deg)  translateZ(0px)   translateY(0px); opacity: .18; }
            30%  { transform: perspective(700px) rotateY(270deg) rotateX(20deg)  rotateZ(-15deg) translateZ(50px)  translateY(-30px); opacity: .38; }
            60%  { transform: perspective(700px) rotateY(360deg) rotateX(-8deg)  rotateZ(5deg)   translateZ(80px)  translateY(-10px); opacity: .45; }
            100% { transform: perspective(700px) rotateY(540deg) rotateX(-12deg) rotateZ(10deg)  translateZ(0px)   translateY(0px); opacity: .18; }
        }
        @keyframes cross3D_C {
            0%   { transform: perspective(1000px) rotateY(45deg)  rotateX(20deg)  rotateZ(-20deg) translateZ(20px)  translateY(0px)   scale(1); opacity: .15; }
            33%  { transform: perspective(1000px) rotateY(165deg) rotateX(-15deg) rotateZ(10deg)  translateZ(90px)  translateY(-35px) scale(1.2); opacity: .40; }
            66%  { transform: perspective(1000px) rotateY(285deg) rotateX(25deg)  rotateZ(-5deg)  translateZ(40px)  translateY(-20px) scale(.9); opacity: .28; }
            100% { transform: perspective(1000px) rotateY(405deg) rotateX(20deg)  rotateZ(-20deg) translateZ(20px)  translateY(0px)   scale(1); opacity: .15; }
        }
        @keyframes cross3D_D {
            0%   { transform: perspective(600px)  rotateY(0deg)   rotateX(0deg)   rotateZ(45deg)  translateZ(0px)  translateY(0px); opacity: .22; }
            50%  { transform: perspective(600px)  rotateY(240deg) rotateX(-30deg) rotateZ(-30deg) translateZ(100px) translateY(-50px); opacity: .50; }
            100% { transform: perspective(600px)  rotateY(360deg) rotateX(0deg)   rotateZ(45deg)  translateZ(0px)  translateY(0px); opacity: .22; }
        }
        @keyframes cross3D_E {
            0%,100% { transform: perspective(800px) rotateY(0deg)   rotateX(30deg)  scale(1)   translateY(0px); opacity:.18; }
            40%     { transform: perspective(800px) rotateY(200deg) rotateX(-20deg) scale(1.3) translateY(-40px); opacity:.42; }
            70%     { transform: perspective(800px) rotateY(320deg) rotateX(15deg)  scale(.8)  translateY(-20px); opacity:.30; }
        }
        @keyframes crossPulseGlow {
            0%,100% { filter: drop-shadow(0 0 4px rgba(220,38,38,.2)); }
            50%     { filter: drop-shadow(0 0 14px rgba(220,38,38,.7)); }
        }


        .bg-cross-3d {
            position: fixed; pointer-events: none; z-index: 0;
            will-change: transform, opacity;
            transform-style: preserve-3d;
        }
        .bg-cross-3d svg { width: 100%; height: 100%; }

        /* ===== NAVBAR with 3D PMR effects ===== */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 56px;
            background: rgba(10,10,10,.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,.06);
            animation: fadeDown .7s ease both;
        }
        .nav-3d-crosses {
            position: absolute; inset: 0; overflow: hidden; pointer-events: none;
            perspective: 600px;
        }
        .nav-3d-cross {
            position: absolute; width: 14px; height: 14px; opacity: 0.08;
            will-change: transform;
        }
        .nav-3d-cross svg { width: 100%; height: 100%; }
        .nav-3d-cross:nth-child(1) { top: 50%; left: 15%; animation: navCrossFloat1 8s ease-in-out infinite; }
        .nav-3d-cross:nth-child(2) { top: 30%; left: 40%; animation: navCrossFloat2 10s ease-in-out infinite 1s; }
        .nav-3d-cross:nth-child(3) { top: 60%; left: 65%; animation: navCrossFloat1 9s ease-in-out infinite 2s; }
        .nav-3d-cross:nth-child(4) { top: 40%; left: 85%; animation: navCrossFloat2 11s ease-in-out infinite .5s; }
        .nav-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; position: relative; z-index: 1; }
        .nav-logo-wrap {
            width: 56px; height: 56px; position: relative;
            transform-style: preserve-3d; perspective: 400px;
            will-change: transform;
        }
        .nav-logo {
            width: 56px; height: 56px; object-fit: contain; border-radius: 10px;
            filter: drop-shadow(0 0 8px rgba(220,38,38,.4));
            animation: navLogoFloat3D 6s ease-in-out infinite;
            will-change: transform;
        }
        .nav-logo-glow {
            position: absolute; inset: -6px; border-radius: 50%;
            background: radial-gradient(circle, rgba(220,38,38,.15) 0%, transparent 70%);
            animation: navGlowPulse 3s ease-in-out infinite;
            will-change: transform, opacity;
        }
        .nav-title {
            font-family: 'Sansita', Georgia, serif;
            font-size: 18px; font-weight: 700; background: linear-gradient(90deg,#EF4444,#DC2626); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .nav-actions { display: flex; align-items: center; gap: 16px; }
        .nav-link {
            font-family: 'Sansita', Georgia, serif, sans-serif, monospace;
            font-size: 12.6px; font-weight: 400; color: #888;
            text-decoration: none; letter-spacing: .5px; transition: color .2s;
        }
        .nav-link:hover { color: #fff; }
        .nav-admin-link {
            font-family: 'Sansita', Georgia, serif, sans-serif, monospace;
            font-size: 12.6px; color: #EF4444; text-decoration: none; letter-spacing: .5px;
            padding: 8px 20px; border: 1px solid rgba(220,38,38,.3); border-radius: 7.2px;
            transition: background .2s, box-shadow .2s;
        }
        .nav-admin-link:hover { background: rgba(220,38,38,.08); box-shadow: 0 0 12px rgba(220,38,38,.1); }

        .page-wrap {
            min-height: 100vh; padding: 108px 56px 72px;
            display: flex; flex-direction: column; align-items: center;
            position: relative; z-index: 1;
        }

        .page-header { text-align: center; max-width: 580px; margin-bottom: 36px; animation: fadeUp .7s .2s ease both; }
        .page-badge {
            display: inline-block;
            background: rgba(220,38,38,.12); border: 1px solid rgba(220,38,38,.25);
            color: #EF4444; font-family: 'Sansita', Georgia, serif, sans-serif, monospace;
            font-size: 12.6px; font-weight: 400; letter-spacing: 1.2px;
            text-transform: uppercase; padding: 8px 20px; border-radius: 50px; margin-bottom: 16px;
        }
        .page-title {
            font-family: 'Sansita', Georgia, serif;
            font-size: 32.4px; font-weight: 700; margin-bottom: 12px; color: #fff;
        }
        .page-title span { background: linear-gradient(135deg,#EF4444,#DC2626); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .page-sub { color: #888; font-size: 14.4px; line-height: 1.6; }

        /* ===== STEPS BAR ===== */
        .steps-bar {
            display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; align-items: center;
            margin-bottom: 44px; width: 100%; max-width: 620px;
            animation: fadeUp .7s .3s ease both;
        }
        .step-item {
            display: inline-flex; height: 40px; align-items: center;
            border-radius: 7.2px; background: rgba(255,255,255,.04); color: #555;
            cursor: default; transition: background .3s, color .3s, border-color .3s, box-shadow .3s;
            border: 1px solid rgba(255,255,255,.08);
        }
        .step-item.active { background: linear-gradient(135deg, #DC2626, #991B1B); color: #FFFFFF; border-color: #DC2626; box-shadow: 0 0 20px rgba(220,38,38,.3); }
        .step-item.done { background: rgba(220,38,38,.08); color: #EF4444; border-color: rgba(220,38,38,.3); }
        .step-icon { display: flex; width: 40px; height: 40px; flex-shrink: 0; align-items: center; justify-content: center; }
        .step-icon svg { width: 18px; height: 18px; stroke-width: 2; }
        .step-label {
            max-width: 0; opacity: 0; white-space: nowrap;
            font-family: 'Sansita', Georgia, serif, sans-serif, monospace; font-size: 12.6px; font-weight: 400; letter-spacing: .3px;
            transition: max-width .4s cubic-bezier(.16,1,.3,1), opacity .3s, padding .4s; padding-right: 0;
        }
        .step-item.active .step-label, .step-item.done .step-label {
            max-width: 200px; opacity: 1; padding-right: 16px;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);
            border-radius: 7.2px; padding: 44px 36px;
            width: 100%; max-width: 680px;
            box-shadow: 0 20px 60px rgba(0,0,0,.5);
            animation: fadeUp .7s .4s ease both;
            position: relative; overflow: hidden;
        }
        .form-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, #DC2626, transparent);
        }

        .form-section { display: none; }
        .form-section.active { display: block; animation: slideIn .4s ease both; }

        .section-heading {
            font-family: 'Sansita', Georgia, serif;
            font-size: 18px; font-weight: 700; color: #EF4444;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px; padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .form-row { display: grid; gap: 16px; grid-template-columns: 1fr; margin-bottom: 16px; }
        .form-row.two-col { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }

        .form-group { display: flex; flex-direction: column; gap: 6px; }
        label { font-size: 14.4px; font-weight: 600; color: #ccc; letter-spacing: .3px; }
        label .req { color: #EF4444; margin-left: 2px; }

        input[type="text"], input[type="email"], input[type="tel"],
        input[type="date"], select, textarea {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1);
            border-radius: 3.6px; color: #fff;
            font-family: 'Sansita', Georgia, serif, -apple-system, sans-serif;
            font-size: 16.2px; padding: 12px 16px;
            transition: border-color .25s, box-shadow .25s;
            outline: none; width: 100%;
        }
        input::placeholder, textarea::placeholder { color: #555; }
        input:focus, select:focus, textarea:focus {
            border-color: #DC2626;
            box-shadow: 0 0 0 2px rgba(220,38,38,.15);
        }
        input.error, select.error, textarea.error { border-color: #EF4444; animation: shake .4s ease; }
        select option { background: #1a1a1a; color: #fff; }
        textarea { resize: vertical; min-height: 100px; }

        .radio-group { display: flex; gap: 16px; flex-wrap: wrap; }
        .radio-opt {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1);
            border-radius: 3.6px; padding: 12px 16px; cursor: pointer;
            transition: border-color .2s, background .2s; flex: 1; min-width: 100px;
        }
        .radio-opt input[type="radio"] { accent-color: #DC2626; width: 16px; height: 16px; }
        .radio-opt:has(input:checked) { border-color: #DC2626; background: rgba(220,38,38,.06); box-shadow: 0 0 12px rgba(220,38,38,.1); }
        .radio-opt span { font-size: 14.4px; font-weight: 600; color: #ccc; }

        .error-msg { font-size: 12.6px; color: #EF4444; margin-top: 4px; display: none; }
        .error-msg.show { display: block; }

        .server-errors {
            background: rgba(239,68,68,.06); border: 1px solid rgba(239,68,68,.2);
            border-radius: 7.2px; padding: 16px 20px; margin-bottom: 20px;
        }
        .server-errors p { color: #EF4444; font-size: 14.4px; margin-bottom: 4px; }
        .server-errors p:last-child { margin-bottom: 0; }

        .alert-closed {
            background: rgba(245,158,11,.06); border: 1px solid rgba(245,158,11,.3);
            border-radius: 7.2px; padding: 16px 20px; margin-bottom: 20px;
            color: #F59E0B; font-size: 14.4px; text-align: center;
        }

        .form-nav { display: flex; justify-content: space-between; align-items: center; margin-top: 28px; gap: 16px; }
        .btn-ghost {
            background: transparent; color: #aaa; border: 1px solid rgba(255,255,255,.1);
            font-family: 'Sansita', Georgia, serif, -apple-system, sans-serif;
            font-weight: 600; font-size: 14.4px;
            padding: 12px 28px; border-radius: 7.2px; cursor: pointer;
            transition: border-color .2s, color .2s;
        }
        .btn-ghost:hover { border-color: #EF4444; color: #EF4444; }
        .btn-next, .btn-submit {
            background: linear-gradient(135deg, #DC2626, #991B1B); color: #FFFFFF; border: none;
            font-family: 'Sansita', Georgia, serif, -apple-system, sans-serif;
            font-weight: 600; font-size: 14.4px;
            padding: 12px 28px; border-radius: 7.2px; cursor: pointer;
            transition: opacity .2s, transform .2s, box-shadow .2s; display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 20px rgba(220,38,38,.3);
        }
        .btn-next:hover, .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(220,38,38,.45); }
        .btn-submit .spinner {
            width: 16px; height: 16px; border: 2px solid rgba(255,255,255,.3);
            border-top-color: #fff; border-radius: 50%; animation: spin .7s linear infinite; display: none;
        }
        .btn-submit.loading .spinner { display: block; }
        .btn-submit.loading .btn-text { opacity: .7; }

        .char-hint { font-size: 12.6px; color: #555; margin-top: 4px; }
        .form-hint { text-align: center; font-size: 14.4px; color: #555; margin-top: 20px; }
        .form-hint a { color: #EF4444; text-decoration: none; }
        .form-hint a:hover { text-decoration: underline; }

        .sum-table { background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px; padding: 20px 24px; margin-bottom: 24px; font-size: 14.4px; }
        .sum-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,.04); gap: 16px; }
        .sum-row:last-child { border-bottom: none; }
        .sum-key { color: #888; flex-shrink: 0; min-width: 120px; font-family: 'Sansita', Georgia, serif, sans-serif, monospace; font-size: 12.6px; }
        .sum-val { color: #fff; font-weight: 600; text-align: right; word-break: break-word; }
        .sum-motivation { color: #ccc; font-style: italic; line-height: 1.6; margin-top: 4px; font-size: 14.4px; }

        @media (max-width: 1024px) {
            nav { padding: 16px 28px; }
            .page-wrap { padding: 92px 28px 52px; }
        }
        @media (max-width: 640px) {
            nav { padding: 12px 16px; }
            .form-card { padding: 28px 16px; }
            .page-title { font-size: 24px; }
            .page-wrap { padding: 72px 16px 36px; }
        }

        /* ===== EMOJI FLOATING BACKGROUND ===== */
        @keyframes emojiFloat1 {
            0%,100% { transform: translateY(0px)   rotate(0deg)   scale(1);   opacity:.25; }
            25%     { transform: translateY(-18px)  rotate(8deg)   scale(1.1); opacity:.45; }
            50%     { transform: translateY(-30px)  rotate(-5deg)  scale(.95); opacity:.30; }
            75%     { transform: translateY(-12px)  rotate(12deg)  scale(1.05);opacity:.40; }
        }
        @keyframes emojiFloat2 {
            0%,100% { transform: translateY(0px)   rotate(0deg)   scale(1);   opacity:.20; }
            33%     { transform: translateY(-25px)  rotate(-10deg) scale(1.15);opacity:.45; }
            66%     { transform: translateY(-10px)  rotate(6deg)   scale(.9);  opacity:.28; }
        }
        @keyframes emojiFloat3 {
            0%,100% { transform: translateY(0px)   rotate(0deg)   scale(1);   opacity:.22; }
            40%     { transform: translateY(-20px)  rotate(15deg)  scale(1.2); opacity:.50; }
            70%     { transform: translateY(-8px)   rotate(-8deg)  scale(.85); opacity:.25; }
        }
        @keyframes emojiSpin {
            0%,100% { transform: rotate(0deg)   scale(1);   opacity:.22; }
            50%     { transform: rotate(180deg) scale(1.1); opacity:.45; }
        }
        .bg-emoji {
            position: fixed; pointer-events: none; z-index: 0;
            font-size: 24px; line-height: 1;
            will-change: transform, opacity;
            user-select: none;
        }
    </style>
</head>
<body>
{{-- Emoji medis melayang di background --}}
<div class="bg-emoji" style="top:18%;left:88%; font-size:22px; animation:emojiFloat1 9s  ease-in-out infinite 0s;">🩺</div>
<div class="bg-emoji" style="top:35%;left:6%;  font-size:18px; animation:emojiFloat2 12s ease-in-out infinite 1s;">🩹</div>
<div class="bg-emoji" style="top:62%;left:82%; font-size:20px; animation:emojiFloat3 10s ease-in-out infinite 2s;">💉</div>
<div class="bg-emoji" style="top:75%;left:25%; font-size:16px; animation:emojiFloat1 11s ease-in-out infinite 3s;">🫀</div>
<div class="bg-emoji" style="top:22%;left:55%; font-size:14px; animation:emojiFloat2 8s  ease-in-out infinite 0.5s;">🚑</div>
<div class="bg-emoji" style="top:88%;left:45%; font-size:18px; animation:emojiFloat3 13s ease-in-out infinite 1.5s;">🩻</div>
<div class="bg-emoji" style="top:50%;left:18%; font-size:15px; animation:emojiSpin   14s ease-in-out infinite 4s;">💊</div>
<div class="bg-emoji" style="top:8%; left:70%; font-size:13px; animation:emojiFloat1 7s  ease-in-out infinite 2.5s;">🩸</div>

{{-- Palang merah 3D background — inline style agar tidak bergantung nth-child --}}
<div class="bg-cross-3d" style="width:28px;height:28px;top:10%;left:5%;  animation:cross3D_A 14s ease-in-out infinite 0s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:22px;height:22px;top:80%;left:13%; animation:cross3D_C 17s ease-in-out infinite 3s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:30px;height:30px;top:70%;left:90%; animation:cross3D_B 11s ease-in-out infinite 1.5s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:20px;height:20px;top:15%;left:78%; animation:cross3D_D 9s  ease-in-out infinite 0.5s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:38px;height:38px;top:45%;left:95%; animation:cross3D_E 13s ease-in-out infinite 2s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:25px;height:25px;top:30%;left:2%;  animation:cross3D_B 15s ease-in-out infinite 4s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:44px;height:44px;top:55%;left:50%; animation:cross3D_A 20s ease-in-out infinite 1s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:18px;height:18px;top:5%; left:45%; animation:cross3D_D 10s ease-in-out infinite 2.5s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:34px;height:34px;top:90%;left:60%; animation:cross3D_C 16s ease-in-out infinite 0.8s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>
<div class="bg-cross-3d" style="width:16px;height:16px;top:40%;left:30%; animation:cross3D_E 8s  ease-in-out infinite 3.5s;"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1.5"/><rect x="2" y="9" width="20" height="6" rx="1.5"/></svg></div>

<nav>
    {{-- 3D floating Red Cross symbols in navbar --}}
    <div class="nav-3d-crosses">
        <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
    </div>
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-logo-wrap">
            <div class="nav-logo-glow"></div>
            <img src="{{ asset('parstama_logo.png') }}" alt="PMR Logo" class="nav-logo">
        </div>
        <span class="nav-title">PMR PARSTAMA</span>
    </a>
    <div class="nav-actions">
        <a href="{{ url('/') }}" class="nav-link">← Beranda</a>
        <a href="{{ route('registration.status') }}" class="nav-link">Cek Status</a>
        <a href="{{ route('login') }}" class="nav-admin-link">Login Admin</a>
    </div>
</nav>

{{-- Hidden field to pass server-side error step to JS --}}
@if($errors->has('full_name') || $errors->has('gender') || $errors->has('birth_place') || $errors->has('birth_date'))
    <input type="hidden" id="error-step_data" value="1">
@elseif($errors->has('whatsapp') || $errors->has('address') || $errors->has('class') || $errors->has('major'))
    <input type="hidden" id="error-step_data" value="2">
@elseif($errors->has('motivation'))
    <input type="hidden" id="error-step_data" value="3">
@elseif($errors->has('parent_consent'))
    <input type="hidden" id="error-step_data" value="4">
@endif

<div class="page-wrap">

    <div class="page-header">
        <div class="page-badge">Pendaftaran Anggota 2025/2026</div>
        <h1 class="page-title">Formulir <span>Pendaftaran</span></h1>
        <p class="page-sub">Isi data diri Anda dengan lengkap dan benar. Proses pendaftaran hanya memerlukan beberapa menit.</p>
    </div>

    <div class="steps-bar">
        <div class="step-item active" id="step-ind-1">
            <span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
            <span class="step-label">Data Diri</span>
        </div>
        <div class="step-item" id="step-ind-2">
            <span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
            <span class="step-label">Kontak & Sekolah</span>
        </div>
        <div class="step-item" id="step-ind-3">
            <span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
            <span class="step-label">Motivasi</span>
        </div>
        <div class="step-item" id="step-ind-4">
            <span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
            <span class="step-label">Konfirmasi</span>
        </div>
    </div>

    <div class="form-card">

        @if(session('error'))
        <div class="alert-closed">⚠ {{ session('error') }}</div>
        @endif

        @if(!$registrationOpen)
        <div class="alert-closed">
            Pendaftaran saat ini <strong>telah ditutup</strong>. Silakan cek kembali nanti.
        </div>
        @endif

        @if($errors->any())
        <div class="server-errors">
            @foreach($errors->all() as $error)
                <p>⚠ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('registration.store') }}" id="regForm" novalidate>
            @csrf

            {{-- STEP 1: DATA DIRI --}}
            <div class="form-section active" id="section-1">
                <div class="section-heading">Data Diri</div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label for="full_name">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="full_name" name="full_name" placeholder="Sesuai kartu identitas" value="{{ old('full_name') }}" autocomplete="name">
                        <span class="error-msg" id="err-full_name">Nama lengkap wajib diisi.</span>
                    </div>
                    <div class="form-group">
                        <label for="nickname">Nama Panggilan</label>
                        <input type="text" id="nickname" name="nickname" placeholder="Opsional" value="{{ old('nickname') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="req">*</span></label>
                        <div class="radio-group" id="gender-group">
                            <label class="radio-opt"><input type="radio" name="gender" value="L" {{ old('gender') == 'L' ? 'checked' : '' }}><span>Laki-laki</span></label>
                            <label class="radio-opt"><input type="radio" name="gender" value="P" {{ old('gender') == 'P' ? 'checked' : '' }}><span>Perempuan</span></label>
                        </div>
                        <span class="error-msg" id="err-gender">Jenis kelamin wajib dipilih.</span>
                    </div>
                </div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label for="birth_place">Tempat Lahir <span class="req">*</span></label>
                        <input type="text" id="birth_place" name="birth_place" placeholder="Kota tempat lahir" value="{{ old('birth_place') }}">
                        <span class="error-msg" id="err-birth_place">Tempat lahir wajib diisi.</span>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Tanggal Lahir <span class="req">*</span></label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                        <span class="error-msg" id="err-birth_date">Tanggal lahir wajib diisi.</span>
                    </div>
                </div>
                <div class="form-nav" style="justify-content:flex-end;">
                    <button type="button" class="btn-next" onclick="goToStep(2)">Selanjutnya →</button>
                </div>
            </div>

            {{-- STEP 2: KONTAK & SEKOLAH --}}
            <div class="form-section" id="section-2">
                <div class="section-heading">Kontak & Data Sekolah</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="whatsapp">Nomor WhatsApp <span class="req">*</span></label>
                        <input type="tel" id="whatsapp" name="whatsapp" placeholder="08xxxxxxxxxx" value="{{ old('whatsapp') }}" autocomplete="tel">
                        <span class="error-msg" id="err-whatsapp">Nomor WhatsApp wajib diisi.</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" autocomplete="email">
                        <span class="char-hint">Opsional — untuk menerima informasi seleksi</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Alamat Lengkap <span class="req">*</span></label>
                        <textarea id="address" name="address" placeholder="Jl. Nama Jalan No. XX, RT/RW, Kelurahan, Kecamatan, Kota">{{ old('address') }}</textarea>
                        <span class="error-msg" id="err-address">Alamat wajib diisi.</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" id="city" name="city" placeholder="Nama kota" value="{{ old('city') }}">
                    </div>
                </div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label for="class">Kelas <span class="req">*</span></label>
                        <input type="text" id="class" name="class" placeholder="Contoh: X / 10" value="{{ old('class') }}">
                        <span class="error-msg" id="err-class">Kelas wajib diisi.</span>
                    </div>
                    <div class="form-group">
                        <label for="class">Jurusan <span class="req">*</span></label>
                        <input type="text" id="major" name="major" placeholder="Contoh: TAB 1 / TAB 2 / TAB 3" value="{{ old('major') }}">
                        </select>
                        <span class="error-msg" id="err-major">Jurusan wajib dipilih.</span>
                    </div>
                </div>
                <div class="form-nav">
                    <button type="button" class="btn-ghost" onclick="goToStep(1)">← Kembali</button>
                    <button type="button" class="btn-next" onclick="goToStep(3)">Selanjutnya →</button>
                </div>
            </div>

            {{-- STEP 3: MOTIVASI --}}
            <div class="form-section" id="section-3">
                <div class="section-heading">Motivasi</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="motivation">Alasan Bergabung dengan PMR PARSTAMA <span class="req">*</span></label>
                        <textarea id="motivation" name="motivation" placeholder="Ceritakan alasan Anda ingin bergabung, pengalaman yang diharapkan, dan kontribusi yang ingin diberikan..." style="min-height:180px;">{{ old('motivation') }}</textarea>
                        <span class="error-msg" id="err-motivation">Kolom motivasi wajib diisi (minimal 20 karakter).</span>
                        <span class="char-hint" id="mot-counter">0 karakter</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="organization_experience">Pengalaman Organisasi Sebelumnya</label>
                        <textarea id="organization_experience" name="organization_experience" placeholder="Tuliskan pengalaman organisasi Anda sebelumnya. Kosongkan jika tidak ada." style="min-height:110px;">{{ old('organization_experience') }}</textarea>
                        <span class="char-hint">Opsional — pengalaman tidak wajib</span>
                    </div>
                </div>
                <div class="form-nav">
                    <button type="button" class="btn-ghost" onclick="goToStep(2)">← Kembali</button>
                    <button type="button" class="btn-next" onclick="goToStep(4)">Selanjutnya →</button>
                </div>
            </div>

            {{-- STEP 4: KONFIRMASI --}}
            <div class="form-section" id="section-4">
                <div class="section-heading">Konfirmasi Data</div>
                <div class="sum-table" id="summary-box">
                    <div class="sum-row"><span class="sum-key">Nama Lengkap</span><span class="sum-val" id="sum-full_name"></span></div>
                    <div class="sum-row"><span class="sum-key">Jenis Kelamin</span><span class="sum-val" id="sum-gender"></span></div>
                    <div class="sum-row"><span class="sum-key">Tempat, Tanggal Lahir</span><span class="sum-val" id="sum-birth"></span></div>
                    <div class="sum-row"><span class="sum-key">WhatsApp</span><span class="sum-val" id="sum-whatsapp"></span></div>
                    <div class="sum-row"><span class="sum-key">Kelas / Jurusan</span><span class="sum-val" id="sum-class"></span></div>
                    <div class="sum-row" style="flex-direction:column;align-items:flex-start;">
                        <span class="sum-key">Motivasi</span>
                        <div class="sum-motivation" id="sum-motivation"></div>
                    </div>
                </div>
                <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;font-size:14.4px;color:#E0E0E0;margin-bottom:24px;">
                    <input type="checkbox" id="agree" name="parent_consent" value="1" {{ old('parent_consent') ? 'checked' : '' }} style="width:18px;height:18px;flex-shrink:0;margin-top:2px;accent-color:#DC2626;">
                    <span>Saya menyatakan bahwa data yang saya isi adalah <strong style="color:#fff;">benar dan dapat dipertanggungjawabkan</strong>, sudah mendapatkan <strong style="color:#fff;">izin dari orang tua / wali</strong>, serta bersedia mengikuti seluruh proses seleksi PMR PARSTAMA.</span>
                </label>
                <span class="error-msg {{ $errors->has('parent_consent') ? 'show' : '' }}" id="err-agree" style="margin-bottom:16px;">Anda harus menyetujui pernyataan dan persetujuan orang tua / wali di atas.</span>
                <div class="form-nav">
                    <button type="button" class="btn-ghost" onclick="goToStep(3)">← Kembali</button>
                    <button type="submit" class="btn-submit" id="submitBtn" {{ !$registrationOpen ? 'disabled' : '' }}>
                        <div class="spinner"></div>
                        <span class="btn-text">Kirim Pendaftaran</span>
                    </button>
                </div>
            </div>

        </form>

        <p class="form-hint">
            Sudah mendaftar? <a href="{{ route('registration.status') }}">Cek status pendaftaran</a> atau <a href="{{ url('/') }}">kembali ke beranda</a>
        </p>
    </div>
</div>

<script>
    let currentStep = 1;
    const TOTAL = 4;

    function goToStep(step) {
        if (step > currentStep && !validateStep(currentStep)) return;
        document.querySelectorAll('.form-section').forEach((el, i) => {
            el.classList.toggle('active', i + 1 === step);
        });
        for (let i = 1; i <= TOTAL; i++) {
            const dot = document.getElementById('step-ind-' + i);
            dot.classList.remove('active', 'done');
            if (i < step) dot.classList.add('done');
            if (i === step) dot.classList.add('active');
        }
        if (step === 4) updateSummary();
        currentStep = step;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(step) {
        let ok = true;
        if (step === 1) {
            ok = requireField('full_name','err-full_name') & requireRadio('gender','err-gender') & requireField('birth_place','err-birth_place') & requireField('birth_date','err-birth_date');
        }
        if (step === 2) {
            ok = requireField('whatsapp','err-whatsapp') & requireField('address','err-address') & requireField('class','err-class') & requireSelect('major','err-major');
        }
        if (step === 3) {
            ok = requireMinLen('motivation','err-motivation', 20);
        }
        return !!ok;
    }

    function requireField(id, errId) {
        const el = document.getElementById(id); const err = document.getElementById(errId);
        const ok = el.value.trim() !== '';
        el.classList.toggle('error', !ok); err.classList.toggle('show', !ok);
        if (ok) el.addEventListener('input', () => { el.classList.remove('error'); err.classList.remove('show'); }, { once: true });
        return ok;
    }
    function requireMinLen(id, errId, min) {
        const el = document.getElementById(id); const err = document.getElementById(errId);
        const ok = el.value.trim().length >= min;
        el.classList.toggle('error', !ok); err.classList.toggle('show', !ok);
        return ok;
    }
    function requireSelect(id, errId) {
        const el = document.getElementById(id); const err = document.getElementById(errId);
        const ok = el.value !== '';
        el.classList.toggle('error', !ok); err.classList.toggle('show', !ok);
        return ok;
    }
    function requireRadio(name, errId) {
        const checked = document.querySelector('input[name="'+name+'"]:checked');
        const err = document.getElementById(errId);
        const ok = checked !== null;
        err.classList.toggle('show', !ok);
        return ok;
    }

    function updateSummary() {
        const genderEl = document.querySelector('input[name="gender"]:checked');
        document.getElementById('sum-full_name').textContent = document.getElementById('full_name').value;
        document.getElementById('sum-gender').textContent = genderEl ? (genderEl.value === 'L' ? 'Laki-laki' : 'Perempuan') : '-';
        const bp = document.getElementById('birth_place').value;
        const bd = document.getElementById('birth_date').value;
        document.getElementById('sum-birth').textContent = bp && bd ? bp + ', ' + bd : (bp || bd || '-');
        document.getElementById('sum-whatsapp').textContent = document.getElementById('whatsapp').value;
        const cls = document.getElementById('class').value;
        const maj = document.getElementById('major').value;
        document.getElementById('sum-class').textContent = cls && maj ? cls + ' / ' + maj : (cls || maj || '-');
        const mot = document.getElementById('motivation').value.trim();
        document.getElementById('sum-motivation').textContent = mot.length > 250 ? mot.substring(0,250) + '...' : mot;
    }

    const motEl = document.getElementById('motivation');
    const counter = document.getElementById('mot-counter');
    motEl.addEventListener('input', () => {
        const len = motEl.value.length;
        counter.textContent = len + ' karakter' + (len < 20 ? ' (min. 20)' : ' ok');
        counter.style.color = len >= 20 ? '#EF4444' : '#555';
    });

    document.getElementById('regForm').addEventListener('submit', function(e) {
        const agree = document.getElementById('agree');
        const errAgree = document.getElementById('err-agree');
        if (!agree.checked) { e.preventDefault(); errAgree.classList.add('show'); return; }
        errAgree.classList.remove('show');
        const btn = document.getElementById('submitBtn');
        btn.classList.add('loading'); btn.disabled = true;
    });

    // Auto-navigate to step with server-side validation errors
    const errorStep = document.getElementById('error-step_data');
    if (errorStep) {
        const step = parseInt(errorStep.value, 10);
        if (step > 0) { currentStep = 0; goToStep(step); }
    }
</script>
</body>
</html>
