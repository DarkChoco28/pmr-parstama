<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARSTAMA – PMR SMKN 1 Singosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --primary: #DC2626;
            --primary-dark: #991B1B;
            --primary-light: #EF4444;
            --bg: #0A0A0B;
            --surface: #141415;
            --card: #1A1A1C;
            --border: rgba(255,255,255,0.06);
            --text: #E4E4E7;
            --text-secondary: #A1A1AA;
            --text-muted: #71717A;
        }

        body {
            font-family: 'Sansita', Georgia, serif, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(10, 10, 11, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        nav a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
            position: relative;
            animation: navLinkFadeIn 0.6s ease-out backwards;
        }

        nav a:nth-child(1) { animation-delay: 0.1s; }
        nav a:nth-child(2) { animation-delay: 0.2s; }
        nav a:nth-child(3) { animation-delay: 0.3s; }
        nav a:nth-child(4) { animation-delay: 0.4s; }
        nav a:nth-child(5) { animation-delay: 0.5s; }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #EF4444, #DC2626);
            transition: width 0.3s ease;
        }

        nav a:not(.btn):hover {
            color: #fff;
        }

        nav a:not(.btn):hover::after {
            width: 100%;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 24px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 9999px;
            color: var(--primary-light);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        h1 {
            font-size: clamp(36px, 6vw, 72px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .gradient-text {
            background: linear-gradient(135deg, #FF8C00, #EF4444, #DC2626);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 18px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 32px;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            background: var(--surface);
            border-color: rgba(255,255,255,0.15);
        }

        /* Stats */
        .stats {
            display: flex;
            justify-content: center;
            gap: 64px;
            padding: 48px 24px;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Features */
        .features {
            padding: 100px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 800;
            color: #fff;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px;
            transition: all 0.3s;
        }

        .feature-card:hover {
            background: var(--surface);
            border-color: rgba(255,255,255,0.1);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            border: 1px solid rgba(220, 38, 38, 0.15);
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }

        .feature-card p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Split Section */
        .split-section {
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 100px 24px;
        }

        .split-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 64px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .split-title {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .split-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        .req-list {
            list-style: none;
        }

        .req-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            font-size: 15px;
            color: var(--text-secondary);
        }

        .req-list li:last-child {
            border-bottom: none;
        }

        .req-check {
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            flex-shrink: 0;
        }

        .timeline {
            position: relative;
            padding-left: 32px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary), transparent);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 32px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -32px;
            top: 4px;
            width: 14px;
            height: 14px;
            background: var(--primary);
            border-radius: 50%;
            border: 2px solid var(--surface);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
        }

        .timeline-title {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .timeline-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* CTA */
        .cta {
            padding: 100px 24px;
            text-align: center;
        }

        .cta-card {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(153, 27, 27, 0.05));
            border: 1px solid rgba(220, 38, 38, 0.15);
            border-radius: 24px;
            padding: 64px 40px;
            max-width: 900px;
            margin: 0 auto;
        }

        .cta-card h2 {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
        }

        .cta-card p {
            font-size: 16px;
            color: var(--text-secondary);
            margin-bottom: 32px;
        }

        /* Footer */
        footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 64px 24px 32px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1.5fr;
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto 48px;
        }

        .footer-col h4 {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .footer-col p,
        .footer-col a {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.7;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
        }

        .footer-col a:hover {
            color: var(--primary-light);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 32px;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 13px;
        }

        .footer-bottom .brand {
            color: var(--primary-light);
            font-weight: 600;
        }

        /* ===== MODERN NAVBAR ANIMATIONS ===== */
        header {
            animation: navbarSlideDown 0.6s ease-out;
        }

        nav a {
            position: relative;
            animation: navLinkFadeIn 0.6s ease-out backwards;
        }

        nav a:nth-child(1) { animation-delay: 0.1s; }
        nav a:nth-child(2) { animation-delay: 0.2s; }
        nav a:nth-child(3) { animation-delay: 0.3s; }
        nav a:nth-child(4) { animation-delay: 0.4s; }
        nav a:nth-child(5) { animation-delay: 0.5s; }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #EF4444, #DC2626);
            transition: width 0.3s ease;
        }

        nav a:not(.btn):hover::after {
            width: 100%;
        }

        .btn {
            animation: buttonPulseIn 0.6s cubic-bezier(.34,1.56,.64,1) 0.5s backwards;
        }

        @keyframes navbarSlideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes navLinkFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonPulseIn {
            from {
                opacity: 0;
                transform: scale(0.8);
                filter: drop-shadow(0 0 0 rgba(220,38,38,0));
            }
            to {
                opacity: 1;
                transform: scale(1);
                filter: drop-shadow(0 4px 12px rgba(220,38,38,0.3));
            }
        }

        /* ===== HERO 3D ANIMATIONS ===== */
        .hero-content {
            animation: heroContentFadeUp 0.8s ease-out 0.2s backwards;
        }

        .badge {
            animation: badgePulse 0.6s ease-out 0.4s backwards;
        }

        h1 {
            animation: titleShakeIn 0.8s cubic-bezier(.34,1.56,.64,1) 0.5s backwards;
        }

        .hero p {
            animation: descriptionFade 0.8s ease-out 0.6s backwards;
        }

        .hero-buttons {
            animation: buttonsStaggerIn 0.8s ease-out 0.7s backwards;
        }

        @keyframes heroContentFadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes badgePulse {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes titleShakeIn {
            0% {
                opacity: 0;
                transform: translateY(40px) rotateX(20deg);
            }
            100% {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        @keyframes descriptionFade {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes buttonsStaggerIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== 3D STATS ANIMATIONS ===== */
        .stat {
            animation: statCardFloat 0.6s ease-out backwards;
            perspective: 1000px;
        }

        .stat:nth-child(1) { animation-delay: 1.2s; }
        .stat:nth-child(2) { animation-delay: 1.4s; }
        .stat:nth-child(3) { animation-delay: 1.6s; }
        .stat:nth-child(4) { animation-delay: 1.8s; }

        .stat-value {
            animation: statValueCountup 2s ease-out 2s forwards;
            display: inline-block;
            transform-style: preserve-3d;
        }

        .stat:hover .stat-value {
            animation: statFlip 0.6s ease-in-out forwards;
        }

        .stat:hover {
            transform: translateY(-8px) rotateX(5deg);
        }

        @keyframes statCardFloat {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes statFlip {
            0% {
                transform: rotateY(0deg) rotateX(0deg) scale(1);
            }
            50% {
                transform: rotateY(180deg) rotateX(10deg) scale(1.1);
            }
            100% {
                transform: rotateY(360deg) rotateX(0deg) scale(1);
            }
        }

        @keyframes statValueCountup {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== 3D FEATURE CARDS ANIMATIONS ===== */
        .feature-card {
            animation: featureCardSlide 0.6s ease-out backwards;
            perspective: 1000px;
            transform-style: preserve-3d;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.3s; }
        .feature-card:nth-child(3) { animation-delay: 0.4s; }
        .feature-card:nth-child(4) { animation-delay: 0.5s; }
        .feature-card:nth-child(5) { animation-delay: 0.6s; }
        .feature-card:nth-child(6) { animation-delay: 0.7s; }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-12px) perspective(1000px) rotateY(-5deg) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(220,38,38,0.2);
        }

        .feature-icon {
            animation: emojiFloat 3s ease-in-out infinite;
            display: inline-block;
            transition: transform 0.3s;
        }

        .feature-card:hover .feature-icon {
            animation: emoji3DRotate 0.6s ease-in-out forwards;
        }

        @keyframes featureCardSlide {
            from {
                opacity: 0;
                transform: translateY(40px) rotateX(-10deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        @keyframes emojiFloat {
            0%, 100% {
                transform: translateY(0px) rotateZ(0deg);
            }
            50% {
                transform: translateY(-10px) rotateZ(5deg);
            }
        }

        @keyframes emoji3DRotate {
            0% {
                transform: perspective(600px) rotateY(0deg) rotateX(0deg) scale(1);
            }
            50% {
                transform: perspective(600px) rotateY(180deg) rotateX(20deg) scale(1.2);
            }
            100% {
                transform: perspective(600px) rotateY(360deg) rotateX(0deg) scale(1);
            }
        }

        /* ===== ADVANCED RED CROSS 3D ANIMATIONS ===== */
        .nav-3d-cross {
            animation: redCrossSpinComplex 12s linear infinite !important;
        }

        .nav-3d-cross:nth-child(1) {
            animation: redCrossSpinComplex 12s linear infinite, redCrossOrbit1 20s ease-in-out infinite !important;
            animation-delay: 0s, 0s;
        }

        .nav-3d-cross:nth-child(2) {
            animation: redCrossSpinComplex 14s linear infinite, redCrossOrbit2 22s ease-in-out infinite !important;
            animation-delay: 1s, 1s;
        }

        .nav-3d-cross:nth-child(3) {
            animation: redCrossSpinComplex 16s linear infinite, redCrossOrbit1 24s ease-in-out infinite !important;
            animation-delay: 2s, 2s;
        }

        .nav-3d-cross:nth-child(4) {
            animation: redCrossSpinComplex 18s linear infinite, redCrossOrbit2 26s ease-in-out infinite !important;
            animation-delay: 0.5s, 0.5s;
        }

        @keyframes redCrossSpinComplex {
            0% { transform: perspective(600px) rotateX(0deg) rotateY(0deg) rotateZ(0deg); }
            25% { transform: perspective(600px) rotateX(90deg) rotateY(45deg) rotateZ(90deg); }
            50% { transform: perspective(600px) rotateX(180deg) rotateY(90deg) rotateZ(180deg); }
            75% { transform: perspective(600px) rotateX(270deg) rotateY(45deg) rotateZ(270deg); }
            100% { transform: perspective(600px) rotateX(360deg) rotateY(0deg) rotateZ(360deg); }
        }

        @keyframes redCrossOrbit1 {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.1; }
            25% { transform: translate(30px, 20px) scale(1.2); opacity: 0.15; }
            50% { transform: translate(0, 40px) scale(1.1); opacity: 0.2; }
            75% { transform: translate(-30px, 20px) scale(1.2); opacity: 0.15; }
        }

        @keyframes redCrossOrbit2 {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.1; }
            25% { transform: translate(-30px, -20px) scale(1.2); opacity: 0.15; }
            50% { transform: translate(0, -40px) scale(1.1); opacity: 0.2; }
            75% { transform: translate(30px, -20px) scale(1.2); opacity: 0.15; }
        }

        /* ===== TIMELINE ANIMATIONS ===== */
        .timeline-item {
            animation: timelineItemReveal 0.6s ease-out backwards;
        }

        .timeline-item:nth-child(1) { animation-delay: 0.6s; }
        .timeline-item:nth-child(2) { animation-delay: 0.8s; }
        .timeline-item:nth-child(3) { animation-delay: 1s; }
        .timeline-item:nth-child(4) { animation-delay: 1.2s; }

        .timeline-dot {
            animation: timelineDotPulse 2s ease-in-out infinite;
            transition: all 0.3s;
        }

        .timeline-item:hover .timeline-dot {
            transform: scale(1.5);
            box-shadow: 0 0 0 8px rgba(220,38,38,0.3);
        }

        @keyframes timelineItemReveal {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes timelineDotPulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(220,38,38,0.4);
            }
            50% {
                box-shadow: 0 0 0 6px rgba(220,38,38,0.1);
            }
        }

        /* ===== CTA CARD ANIMATIONS ===== */
        .cta-card {
            animation: ctaCardEntrance 0.8s cubic-bezier(.34,1.56,.64,1) backwards;
            perspective: 1000px;
        }

        .cta-card:hover {
            transform: translateY(-8px) rotateX(2deg);
        }

        @keyframes ctaCardEntrance {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ===== FLUID CIRCULAR MENU (Mobile Only) ===== */
        .fluid-menu {
            display: none; /* hidden on desktop */
            position: fixed;
            bottom: 28px;
            right: 24px;
            z-index: 9000;
            width: 56px;
        }

        .fluid-menu-trigger {
            position: relative;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #DC2626, #991B1B);
            border: none;
            cursor: pointer;
            z-index: 9010;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 24px rgba(220, 38, 38, 0.4), 0 0 0 0 rgba(220, 38, 38, 0.3);
            transition: transform 0.2s, box-shadow 0.3s;
            -webkit-tap-highlight-color: transparent;
        }
        .fluid-menu-trigger:hover {
            transform: scale(1.08);
        }
        .fluid-menu-trigger:active {
            transform: scale(0.95);
        }
        /* Pulse ring */
        .fluid-menu-trigger::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid rgba(220, 38, 38, 0.3);
            animation: fluidPulse 2.5s ease-in-out infinite;
        }
        @keyframes fluidPulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.15); opacity: 0; }
        }
        .fluid-menu.open .fluid-menu-trigger::before {
            animation: none;
            opacity: 0;
        }

        /* Icon transition (hamburger ↔ X) */
        .fluid-menu-trigger .icon-hamburger,
        .fluid-menu-trigger .icon-close {
            position: absolute;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fluid-menu-trigger .icon-hamburger {
            opacity: 1; transform: scale(1) rotate(0deg);
        }
        .fluid-menu-trigger .icon-close {
            opacity: 0; transform: scale(0) rotate(-180deg);
        }
        .fluid-menu.open .fluid-menu-trigger .icon-hamburger {
            opacity: 0; transform: scale(0) rotate(180deg);
        }
        .fluid-menu.open .fluid-menu-trigger .icon-close {
            opacity: 1; transform: scale(1) rotate(0deg);
        }

        /* Menu items container */
        .fluid-menu-items {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 56px;
            pointer-events: none;
        }

        /* Individual menu item */
        .fluid-menu-item {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(24, 24, 27, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            cursor: pointer;
            transform: translateY(0) scale(0.6);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
            margin-right: 4px; /* center under the 56px trigger */
        }
        .fluid-menu-item:hover {
            background: rgba(220, 38, 38, 0.15);
            color: #fff;
            border-color: rgba(220, 38, 38, 0.4);
            box-shadow: 0 0 16px rgba(220, 38, 38, 0.2);
        }
        .fluid-menu-item svg {
            width: 20px; height: 20px;
            stroke-width: 1.8;
            transition: stroke-width 0.2s;
        }
        .fluid-menu-item:hover svg {
            stroke-width: 2.4;
        }

        /* Tooltip labels */
        .fluid-menu-item .fluid-label {
            position: absolute;
            right: 60px;
            white-space: nowrap;
            background: rgba(9, 9, 11, 0.95);
            color: rgba(255, 255, 255, 0.9);
            font-size: 12px;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            pointer-events: none;
            opacity: 0;
            transform: translateX(8px);
            transition: opacity 0.2s, transform 0.2s;
        }
        .fluid-menu-item:hover .fluid-label {
            opacity: 1;
            transform: translateX(0);
        }  

        /* CTA special item */
        .fluid-menu-item.fluid-cta {
            background: linear-gradient(135deg, #DC2626, #991B1B);
            border-color: transparent;
            color: #fff;
        }
        .fluid-menu-item.fluid-cta:hover {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            box-shadow: 0 0 20px rgba(220, 38, 38, 0.4);
        }

        /* Open state — fan items upward */
        .fluid-menu.open .fluid-menu-item {
            opacity: 1;
            pointer-events: auto;
            transform: scale(1);
        }
        .fluid-menu.open .fluid-menu-item:nth-child(1) { transform: translateY(-66px) scale(1); transition-delay: 0.03s; }
        .fluid-menu.open .fluid-menu-item:nth-child(2) { transform: translateY(-122px) scale(1); transition-delay: 0.06s; }
        .fluid-menu.open .fluid-menu-item:nth-child(3) { transform: translateY(-178px) scale(1); transition-delay: 0.09s; }
        .fluid-menu.open .fluid-menu-item:nth-child(4) { transform: translateY(-234px) scale(1); transition-delay: 0.12s; }
        .fluid-menu.open .fluid-menu-item:nth-child(5) { transform: translateY(-290px) scale(1); transition-delay: 0.15s; }
        .fluid-menu.open .fluid-menu-item:nth-child(6) { transform: translateY(-346px) scale(1); transition-delay: 0.18s; }
        .fluid-menu.open .fluid-menu-item:nth-child(7) { transform: translateY(-402px) scale(1); transition-delay: 0.21s; }

        /* Closing — reverse delay */
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(7) { transition-delay: 0s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(6) { transition-delay: 0.02s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(5) { transition-delay: 0.04s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(4) { transition-delay: 0.06s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(3) { transition-delay: 0.08s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(2) { transition-delay: 0.1s; }
        .fluid-menu:not(.open) .fluid-menu-item:nth-child(1) { transition-delay: 0.12s; }

        /* Backdrop overlay */
        .fluid-menu-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 8999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .fluid-menu-backdrop.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .fluid-menu {
                display: block;
            }
            nav {
                gap: 16px;
            }
            
            nav a {
                display: none;
            }

            .stats {
                gap: 32px;
            }

            .stat-value {
                font-size: 36px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .feature-card:hover {
                transform: translateY(-8px) perspective(1000px) rotateY(-2deg) rotateX(2deg);
            }
        }

        @media (max-width: 640px) {
            h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .feature-card:hover {
                transform: translateY(-4px);
            }
        }
    </style>
</head>
<body class="preloader-active">
    <!-- Preloader 3D -->
    <div id="preloader" style="position:fixed;inset:0;z-index:9999;background:#0A0A0B;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity .6s ease;">
        <!-- Ring Orbit Luar -->
        <div style="position:absolute;width:280px;height:280px;border-radius:50%;border:1px solid rgba(220,38,38,0.15);animation:orbitRing 4s linear infinite;"></div>
        <div style="position:absolute;width:220px;height:220px;border-radius:50%;border:1px solid rgba(220,38,38,0.25);animation:orbitRing 3s linear infinite reverse;"></div>
        <!-- Logo Wrapper -->
        <div style="position:relative;display:flex;align-items:center;gap:0;animation:preloaderLogoFloat 2s ease-in-out infinite;">
            <img src="{{ asset('parstama_logo.png') }}" alt="PARSTAMA" style="width:120px;height:120px;object-fit:contain;">
        </div>
        <!-- Teks Loading -->
        <div style="margin-top:24px;font-family:'Sansita',serif;font-size:13px;letter-spacing:4px;color:rgba(220,38,38,0.7);text-transform:uppercase;animation:textBlink 1.5s ease-in-out infinite;">PARSTAMA</div>
        <!-- Dot Loader -->
        <div style="display:flex;gap:6px;margin-top:14px;">
            <span style="width:6px;height:6px;border-radius:50%;background:#DC2626;animation:dotBounce 1.2s ease-in-out infinite 0s;"></span>
            <span style="width:6px;height:6px;border-radius:50%;background:#DC2626;animation:dotBounce 1.2s ease-in-out infinite .2s;"></span>
            <span style="width:6px;height:6px;border-radius:50%;background:#DC2626;animation:dotBounce 1.2s ease-in-out infinite .4s;"></span>
        </div>
    </div>
    <style>
        @keyframes preloaderLogoFloat {
            0%, 100% { transform: perspective(800px) rotateY(-8deg) rotateX(3deg) translateY(0px); }
            50% { transform: perspective(800px) rotateY(8deg) rotateX(-3deg) translateY(-10px); }
        }
        @keyframes orbitRing {
            from { transform: rotate(0deg) rotateX(60deg); }
            to { transform: rotate(360deg) rotateX(60deg); }
        }
        @keyframes textBlink {
            0%, 100% { opacity: 0.5; letter-spacing: 4px; }
            50% { opacity: 1; letter-spacing: 6px; }
        }
        @keyframes dotBounce {
            0%, 100% { transform: translateY(0); opacity: 0.4; }
            50% { transform: translateY(-8px); opacity: 1; }
        }
        @keyframes preloaderSpin {
            0% { transform: perspective(1000px) rotateY(0deg) rotateX(0deg) scale(0.8); opacity: 0; }
            50% { transform: perspective(1000px) rotateY(180deg) rotateX(10deg) scale(1); opacity: 1; }
            100% { transform: perspective(1000px) rotateY(360deg) rotateX(0deg) scale(0.8); opacity: 0; }
        }
    </style>

    <style>
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
        .nav-3d-crosses {
            position: absolute; inset: 0; overflow: hidden; pointer-events: none;
            perspective: 600px; z-index: 0;
        }
        .nav-3d-cross {
            position: absolute; width: 14px; height: 14px; opacity: 0.15;
            will-change: transform;
        }
        .nav-3d-cross svg { width: 100%; height: 100%; }
        .nav-3d-cross:nth-child(1) { top: 50%; left: 20%; animation: navCrossFloat1 8s ease-in-out infinite; }
        .nav-3d-cross:nth-child(2) { top: 30%; left: 45%; animation: navCrossFloat2 10s ease-in-out infinite 1s; }
        .nav-3d-cross:nth-child(3) { top: 60%; left: 70%; animation: navCrossFloat1 9s ease-in-out infinite 2s; }
        .nav-3d-cross:nth-child(4) { top: 40%; left: 85%; animation: navCrossFloat2 11s ease-in-out infinite .5s; }
        .home-logo-wrap {
            width: 80px; height: 80px; position: relative;
            display: flex; align-items: center; justify-content: center;
        }
        .home-nav-logo {
            height: 100%; width: 100%; object-fit: contain;
        }
    </style>

    <!-- ===== CANVAS PARTIKEL 3D GLOBAL ===== -->
    <canvas id="particleCanvas" style="position:fixed;inset:0;z-index:0;pointer-events:none;"></canvas>

    <!-- ===== AURORA NEBULA BACKGROUND ===== -->
    <div id="auroraWrap" style="position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden;">
        <div class="aurora-blob aurora-1"></div>
        <div class="aurora-blob aurora-2"></div>
        <div class="aurora-blob aurora-3"></div>
    </div>

    <!-- ===== CSS ANIMASI MENYELURUH ===== -->
    <style>
        /* Aurora Blobs */
        .aurora-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            will-change: transform, opacity;
        }
        .aurora-1 {
            width: 700px; height: 700px;
            top: -200px; left: -200px;
            background: radial-gradient(circle, rgba(220,38,38,0.06) 0%, transparent 70%);
            animation: auroraFloat1 18s ease-in-out infinite;
        }
        .aurora-2 {
            width: 500px; height: 500px;
            bottom: 100px; right: -100px;
            background: radial-gradient(circle, rgba(153,27,27,0.05) 0%, transparent 70%);
            animation: auroraFloat2 22s ease-in-out infinite 4s;
        }
        .aurora-3 {
            width: 400px; height: 400px;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(239,68,68,0.04) 0%, transparent 70%);
            animation: auroraFloat3 15s ease-in-out infinite 2s;
        }
        @keyframes auroraFloat1 {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
            33% { transform: translate(80px, 60px) scale(1.2); opacity: 1; }
            66% { transform: translate(-40px, 100px) scale(0.9); opacity: 0.7; }
        }
        @keyframes auroraFloat2 {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
            40% { transform: translate(-60px, -80px) scale(1.3); opacity: 0.8; }
            70% { transform: translate(50px, -40px) scale(1.1); opacity: 0.6; }
        }
        @keyframes auroraFloat3 {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
            50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.6; }
        }

        /* Grid Perspektif 3D di Hero */
        .hero-grid-3d {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(220,38,38,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(220,38,38,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            transform: perspective(600px) rotateX(40deg) translateY(20%) scaleY(2);
            transform-origin: center bottom;
            pointer-events: none;
            mask-image: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.6) 40%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.6) 40%, transparent 100%);
            animation: gridPulse 4s ease-in-out infinite;
        }
        @keyframes gridPulse {
            0%, 100% { opacity: 0.5; background-size: 60px 60px; }
            50% { opacity: 1; background-size: 62px 62px; }
        }

        /* Floating 3D Orbs di Hero */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            will-change: transform;
        }
        .hero-orb-1 {
            width: 300px; height: 300px;
            top: 10%; right: -80px;
            background: radial-gradient(circle at 40% 40%, rgba(220,38,38,0.15), transparent 70%);
            border: 1px solid rgba(220,38,38,0.08);
            animation: orbFloat1 8s ease-in-out infinite;
        }
        .hero-orb-2 {
            width: 180px; height: 180px;
            bottom: 15%; left: -50px;
            background: radial-gradient(circle at 60% 60%, rgba(239,68,68,0.12), transparent 70%);
            border: 1px solid rgba(239,68,68,0.06);
            animation: orbFloat2 6s ease-in-out infinite 1s;
        }
        .hero-orb-3 {
            width: 100px; height: 100px;
            top: 35%; left: 10%;
            background: radial-gradient(circle, rgba(220,38,38,0.1), transparent 70%);
            border: 1px solid rgba(220,38,38,0.1);
            animation: orbFloat3 10s ease-in-out infinite 2s;
        }
        @keyframes orbFloat1 {
            0%, 100% { transform: perspective(800px) rotateX(10deg) rotateY(-15deg) translateY(0px); }
            50% { transform: perspective(800px) rotateX(-10deg) rotateY(15deg) translateY(-30px); }
        }
        @keyframes orbFloat2 {
            0%, 100% { transform: perspective(600px) rotateX(-8deg) rotateY(12deg) translateY(0px) scale(1); }
            50% { transform: perspective(600px) rotateX(8deg) rotateY(-12deg) translateY(-20px) scale(1.1); }
        }
        @keyframes orbFloat3 {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.6; }
            33% { transform: translateY(-15px) rotate(120deg); opacity: 1; }
            66% { transform: translateY(-8px) rotate(240deg); opacity: 0.8; }
        }

        /* Scroll-reveal animations */
        .reveal {
            opacity: 0;
            transform: translateY(40px) perspective(600px) rotateX(-8deg);
            transition: opacity 0.7s ease, transform 0.7s cubic-bezier(.34,1.56,.64,1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0) perspective(600px) rotateX(0deg);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-50px) perspective(600px) rotateY(15deg);
            transition: opacity 0.7s ease, transform 0.7s cubic-bezier(.34,1.56,.64,1);
        }
        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0) perspective(600px) rotateY(0deg);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px) perspective(600px) rotateY(-15deg);
            transition: opacity 0.7s ease, transform 0.7s cubic-bezier(.34,1.56,.64,1);
        }
        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0) perspective(600px) rotateY(0deg);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.85) perspective(800px) rotateX(10deg);
            transition: opacity 0.6s ease, transform 0.6s cubic-bezier(.34,1.56,.64,1);
        }
        .reveal-scale.visible {
            opacity: 1;
            transform: scale(1) perspective(800px) rotateX(0deg);
        }

        /* Mouse parallax pada hero */
        .hero-parallax-layer {
            transition: transform 0.1s ease-out;
            will-change: transform;
        }

        /* Glassmorphism navbar saat scroll */
        header.scrolled {
            background: rgba(10, 10, 11, 0.97) !important;
            box-shadow: 0 4px 32px rgba(0,0,0,0.5), 0 0 0 1px rgba(220,38,38,0.05);
            backdrop-filter: blur(20px) !important;
        }

        /* Efek shimmer pada stat-value */
        .stat-value {
            position: relative;
            overflow: hidden;
        }
        .stat-value::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            animation: shimmerSlide 3s ease-in-out infinite;
        }
        @keyframes shimmerSlide {
            0% { left: -100%; }
            50%, 100% { left: 200%; }
        }

        /* Efek border glow pada feature cards */
        .feature-card {
            transition: transform 0.4s cubic-bezier(.34,1.56,.64,1), box-shadow 0.4s ease, border-color 0.4s ease !important;
        }
        .feature-card:hover {
            border-color: rgba(220,38,38,0.3) !important;
            box-shadow: 0 0 0 1px rgba(220,38,38,0.2), 0 24px 48px rgba(0,0,0,0.4), 0 0 40px rgba(220,38,38,0.08) !important;
        }

        /* Rotating gradient pada CTA border */
        .cta-card {
            position: relative;
            overflow: hidden;
        }
        .cta-card::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: conic-gradient(from 0deg, transparent 0%, rgba(220,38,38,0.3) 25%, transparent 50%, rgba(220,38,38,0.3) 75%, transparent 100%);
            border-radius: 26px;
            z-index: -1;
            animation: rotateBorder 4s linear infinite;
        }
        @keyframes rotateBorder {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Efek 3D tilt pada req-list item */
        .req-list li {
            transition: transform 0.3s ease, padding-left 0.3s ease, background 0.3s ease;
            border-radius: 8px;
            padding-left: 8px;
            padding-right: 8px;
        }
        .req-list li:hover {
            transform: perspective(400px) translateX(8px) rotateY(-2deg);
            background: rgba(220,38,38,0.04);
        }

        /* Efek glow pada timeline-dot saat hover */
        .timeline-dot {
            transition: transform 0.3s cubic-bezier(.34,1.56,.64,1), box-shadow 0.3s ease !important;
        }

        /* Floating Particles dekorasi */
        .deco-particle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: decoParticleFloat linear infinite;
            opacity: 0;
        }
        @keyframes decoParticleFloat {
            0% { transform: translateY(110vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.4; }
            100% { transform: translateY(-20vh) rotate(720deg); opacity: 0; }
        }

        /* Scan line efek di header */
        header::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(220,38,38,0.6), transparent);
            animation: scanLine 5s linear infinite;
        }
        @keyframes scanLine {
            from { left: -100%; }
            to { left: 200%; }
        }

        /* Cursor glow effect */
        #cursor-glow {
            position: fixed;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(220,38,38,0.06) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out;
            will-change: left, top;
        }

        /* Neon line separator */
        .neon-separator {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(220,38,38,0.4), transparent);
            margin: 0;
            animation: neonPulse 3s ease-in-out infinite;
        }
        @keyframes neonPulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; box-shadow: 0 0 8px rgba(220,38,38,0.5); }
        }
    </style>

    <!-- Cursor Glow -->
    <div id="cursor-glow"></div>

    <header style="position: relative; overflow: hidden;">
        <div class="nav-3d-crosses">
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        </div>
        <a href="{{ url('/') }}" class="logo" style="position: relative; z-index: 1;">
            <div class="home-logo-wrap">
                <img src="{{ asset('smkn_logo.png') }}" alt="PMR" class="home-nav-logo">
            </div>
            <div class="home-logo-wrap">
                <img src="{{ asset('parstama_logo.png') }}" alt="PMR" class="home-nav-logo">
            </div>
            PARSTAMA
        </a>
        <nav style="position: relative; z-index: 1;">
            <a href="#tentang">Tentang</a>
            <a href="#syarat">Syarat</a>
            <a href="#timeline">Timeline</a>
            <a href="{{ route('registration.status') }}">Cek Status</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="https://wa.me/6281932781179?text=Halo%20PARSTAMA,%20saya%20ingin%20bertanya%20tentang%20pendaftaran." target="_blank" rel="noopener">WhatsApp</a>
            <a href="{{ route('registration.create') }}" class="btn">Daftar Sekarang</a>
        </nav>
    </header>

    <!-- ===== FLUID CIRCULAR MENU (Mobile) ===== -->
    <div class="fluid-menu-backdrop" id="fluidBackdrop"></div>
    <div class="fluid-menu" id="fluidMenu">
        <div class="fluid-menu-items">
            <!-- Item 1: Tentang -->
            <a href="#tentang" class="fluid-menu-item">
                <span class="fluid-label">Tentang</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            </a>
            <!-- Item 2: Syarat -->
            <a href="#syarat" class="fluid-menu-item">
                <span class="fluid-label">Syarat</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </a>
            <!-- Item 3: Timeline -->
            <a href="#timeline" class="fluid-menu-item">
                <span class="fluid-label">Timeline</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </a>
            <!-- Item 4: Cek Status -->
            <a href="{{ route('registration.status') }}" class="fluid-menu-item">
                <span class="fluid-label">Cek Status</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </a>
            <!-- Item 5: Login -->
            <a href="{{ route('login') }}" class="fluid-menu-item">
                <span class="fluid-label">Login</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
            </a>
            <!-- Item 6: WhatsApp -->
            <a href="https://wa.me/6281932781179?text=Halo%20PARSTAMA,%20saya%20ingin%20bertanya%20tentang%20pendaftaran." target="_blank" rel="noopener" class="fluid-menu-item" style="color:#25D366; border-color: rgba(37,211,102,0.3);">
                <span class="fluid-label" style="color:#25D366;">WhatsApp</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </a>
            <!-- Item 7: Daftar (CTA) -->
            <a href="{{ route('registration.create') }}" class="fluid-menu-item fluid-cta">
                <span class="fluid-label">Daftar Sekarang</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            </a>
        </div>
        <!-- Trigger Button -->
        <button class="fluid-menu-trigger" id="fluidTrigger" aria-label="Menu Navigasi">
            <span class="icon-hamburger">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </span>
            <span class="icon-close">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </span>
        </button>
    </div>

    <section class="hero" id="heroSection">
        <div id="three-hero-root" style="position: absolute; inset: 0; pointer-events: none; z-index: 0;"></div>
        <!-- Grid Perspektif 3D -->
        <div class="hero-grid-3d"></div>
        <!-- Orb Dekorasi Mengambang -->
        <div class="hero-orb hero-orb-1 hero-parallax-layer" data-speed="0.04"></div>
        <div class="hero-orb hero-orb-2 hero-parallax-layer" data-speed="0.07"></div>
        <div class="hero-orb hero-orb-3 hero-parallax-layer" data-speed="0.05"></div>
        <!-- Ring Dekorasi -->
        <div style="position:absolute;width:600px;height:600px;border-radius:50%;border:1px solid rgba(220,38,38,0.05);top:50%;left:50%;transform:translate(-50%,-50%) rotateX(70deg);animation:heroRingExpand 6s ease-in-out infinite;pointer-events:none;"></div>
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;border:1px solid rgba(220,38,38,0.06);top:50%;left:50%;transform:translate(-50%,-50%) rotateX(70deg);animation:heroRingExpand 6s ease-in-out infinite 2s;pointer-events:none;"></div>
        <style>
            @keyframes heroRingExpand {
                0%, 100% { transform: translate(-50%,-50%) rotateX(70deg) scale(1); opacity: 0.5; }
                50% { transform: translate(-50%,-50%) rotateX(70deg) scale(1.08); opacity: 1; }
            }
        </style>

        <div class="hero-content hero-parallax-layer" data-speed="-0.02">
            <div class="badge reveal">PMR SMKN 1 Singosari</div>
            <h1 class="reveal" style="transition-delay:0.1s;"><span style="white-space:nowrap;">Bergabunglah Bersama</span><br><span class="gradient-text">PMR PARSTAMA</span></h1>
            <p class="reveal" style="transition-delay:0.2s;">Jadilah bagian dari generasi penolong yang hebat. Pelajari keterampilan pertolongan pertama, kembangkan jiwa kepedulian, dan beri dampak nyata bagi masyarakat.</p>
            <div class="hero-buttons reveal" style="transition-delay:0.3s;">
                <a href="{{ route('registration.create') }}" class="btn">Isi Form Pendaftaran</a>
                <a href="{{ route('registration.status') }}" class="btn btn-outline">Cek Status Pendaftaran</a>
            </div>
        </div>
    </section>
    <div class="neon-separator"></div>

    <div class="stats">
        <div class="stat reveal" style="transition-delay:0s;">
            <div class="stat-value" data-target="100">0+</div>
            <div class="stat-label">Anggota Aktif</div>
        </div>
        <div class="stat reveal" style="transition-delay:0.15s;">
            <div class="stat-value" data-target="50">0+</div>
            <div class="stat-label">Kegiatan Sosial</div>
        </div>
        <div class="stat reveal" style="transition-delay:0.3s;">
            <div class="stat-value" data-target="10">0+</div>
            <div class="stat-label">Tahun Berdiri</div>
        </div>
        <div class="stat reveal" style="transition-delay:0.45s;">
            <div class="stat-value" data-target="30">0+</div>
            <div class="stat-label">Penghargaan</div>
        </div>
    </div>
    <div class="neon-separator"></div>

    <section class="features" id="tentang">
        <div class="section-header">
            <h2 class="section-title reveal">Mengapa <span class="gradient-text">PARSTAMA</span>?</h2>
            <p class="section-subtitle reveal" style="transition-delay:0.1s;">Kami bukan sekadar organisasi — kami adalah keluarga yang saling mendukung.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card reveal" style="transition-delay:0s;">
                <div class="feature-icon">🎯</div>
                <h3>Pelatihan Profesional</h3>
                <p>Program latihan terstruktur mencakup PPGD, triage, evakuasi, dan manajemen bencana dari pelatih bersertifikat PMI.</p>
            </div>
            <div class="feature-card reveal" style="transition-delay:0.1s;">
                <div class="feature-icon">🤝</div>
                <h3>Komunitas yang Solid</h3>
                <p>100+ anggota aktif yang berdedikasi, saling mendukung, dan tumbuh bersama dalam kegiatan kemanusiaan.</p>
            </div>
            <div class="feature-card reveal" style="transition-delay:0.2s;">
                <div class="feature-icon">🏆</div>
                <h3>Prestasi Membanggakan</h3>
                <p>Raih pengalaman dan sertifikat bergengsi lewat kompetisi PMR tingkat kecamatan, kota, hingga nasional.</p>
            </div>
            <div class="feature-card reveal" style="transition-delay:0.3s;">
                <div class="feature-icon">🌍</div>
                <h3>Dampak Nyata</h3>
                <p>Terlibat langsung dalam kegiatan donor darah, posko kesehatan, dan misi kemanusiaan di lapangan.</p>
            </div>
            <div class="feature-card reveal" style="transition-delay:0.4s;">
                <div class="feature-icon">📚</div>
                <h3>Pengembangan Diri</h3>
                <p>Tingkatkan jiwa kepemimpinan, komunikasi, dan kerja tim melalui program pelatihan rutin dan seminar.</p>
            </div>
            <div class="feature-card reveal" style="transition-delay:0.5s;">
                <div class="feature-icon">🎖️</div>
                <h3>Sertifikasi Resmi</h3>
                <p>Dapatkan sertifikat resmi dari PMI yang diakui secara nasional sebagai bukti kompetensi Anda.</p>
            </div>
        </div>
    </section>
    <div class="neon-separator"></div>

    <div class="split-section">
        <div class="split-grid">
            <div id="syarat">
                <h3 class="split-title reveal-left">Persyaratan Pendaftaran</h3>
                <p class="split-subtitle reveal-left" style="transition-delay:0.1s;">Pastikan kamu memenuhi semua persyaratan berikut</p>
                <ul class="req-list">
                    <li><span class="req-check">✓</span><span>Merupakan siswa aktif SMKN 1 SINGOSARI</span></li>
                    <li><span class="req-check">✓</span><span>Memiliki semangat kepedulian dan jiwa sukarela</span></li>
                    <li><span class="req-check">✓</span><span>Bersedia mengikuti seluruh rangkaian seleksi</span></li>
                    <li><span class="req-check">✓</span><span>Mendapat izin dari orang tua / wali</span></li>
                    <li><span class="req-check">✓</span><span>Mengetahui dan memiliki minat serta tujuan</span></li>
                </ul>
            </div>
            <div id="timeline">
                <h3 class="split-title">Timeline Seleksi</h3>
                <p class="split-subtitle">Ikuti setiap tahapan seleksi dengan baik</p>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Pendaftaran Online</div>
                        <div class="timeline-desc">Isi formulir pendaftaran melalui website ini.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Seleksi Administrasi</div>
                        <div class="timeline-desc">Tim panitia memeriksa berkas pendaftar.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Wawancara & Tes</div>
                        <div class="timeline-desc">Tes tertulis, fisik, dan wawancara motivasi.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Pengumuman Hasil</div>
                        <div class="timeline-desc">Hasil seleksi diumumkan melalui website dan medsos PMR.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="cta">
        <div class="cta-card">
            <h2>Siap Bergabung?</h2>
            <p>Jangan lewatkan kesempatan menjadi bagian dari keluarga PARSTAMA. Pendaftaran dibuka terbatas!</p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('registration.create') }}" class="btn">Daftar Sekarang - Gratis</a>
                <a href="{{ route('registration.status') }}" class="btn btn-outline">Cek Status</a>
            </div>
        </div>
    </section>

    <footer id="kontak">
        <div class="footer-grid">
        <div class="footer-col">
            <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px; text-decoration: none;">
                <img src="{{ asset('smkn_logo.png') }}" alt="PMR" style="width: 80px; height: 80px; object-fit: contain;">
                <img src="{{ asset('parstama_logo.png') }}" alt="PMR" style="width: 80px; height: 80px; object-fit: contain;">
                <span style="font-weight: 700; font-size: 18px; color: #fff;">PARSTAMA</span>
            </a>
            <p>Palang Merah Remaja atau PARSTAMA adalah organisasi kepemudaan yang berfokus pada kemanusiaan, pertolongan pertama, dan pengembangan karakter siswa.</p>
            <div style="display: flex; gap: 12px; margin-top: 20px;">
                <a href="#" style="width: 56px; height: 56px; border-radius: 10px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; transition: all 0.2s; text-decoration: none;" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--text-muted)">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </a>
                <a href="#" style="width: 56px; height: 56px; border-radius: 10px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; transition: all 0.2s; text-decoration: none;" aria-label="TikTok">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--text-muted)">
                        <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005.8 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1.84-.1z"/>
                    </svg>
                </a>
                <a href="#" style="width: 56px; height: 56px; border-radius: 10px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; transition: all 0.2s; text-decoration: none;" aria-label="YouTube">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--text-muted)">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>
        </div>
            <div class="footer-col">
                <h4>Tautan</h4>
                <a href="#tentang">Tentang</a>
                <a href="#syarat">Persyaratan</a>
                <a href="#timeline">Timeline</a>
                <a href="{{ route('registration.create') }}">Daftar</a>
                <a href="{{ route('registration.status') }}">Cek Status</a>
                <a href="{{ route('login') }}">Login Admin</a>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <p style="margin-bottom: 4px; display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    SMKN 1 Singosari, Malang
                </p>
                <p style="margin-bottom: 4px; display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    pmr.parstama@gmail.com
                </p>
                <a href="https://wa.me/6281932781179" target="_blank" rel="noopener" style="color: #25D366; margin-top: 12px; display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#25D366">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    +62 819-3278-1179
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <span class="brand">PARSTAMA</span>. All rights reserved.</p>
            <p style="margin-top: 8px;">Made with ❤️ by tim PARSTAMA</p>
        </div>
    </footer>

    <script>
        /* ========== PRELOADER ========== */
        window.addEventListener('load', function() {
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                    document.body.classList.remove('preloader-active');
                    // Langsung trigger reveal untuk elemen yang sudah visible
                    checkReveal();
                }, 600);
            }, 1500);
        });

        /* ========== SMOOTH SCROLL ========== */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        /* ========== SCROLL-REVEAL (IntersectionObserver) ========== */
        function checkReveal() {
            const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
            revealEls.forEach(el => observer.observe(el));
        }
        checkReveal();

        /* ========== COUNTER ANIMASI STAT ========== */
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target.querySelector('.stat-value');
                if (!el || el.dataset.counted) return;
                el.dataset.counted = true;
                const target = parseInt(el.dataset.target);
                let current = 0;
                const step = Math.ceil(target / 40);
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = current + '+';
                    if (current >= target) clearInterval(timer);
                }, 40);
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('.stat').forEach(s => statObserver.observe(s));

        /* ========== NAVBAR SCROLLED STATE ========== */
        window.addEventListener('scroll', () => {
            const hdr = document.querySelector('header');
            if (hdr) hdr.classList.toggle('scrolled', window.scrollY > 30);
        }, { passive: true });

        /* ========== CURSOR GLOW ========== */
        const cursorGlow = document.getElementById('cursor-glow');
        document.addEventListener('mousemove', (e) => {
            if (!cursorGlow) return;
            cursorGlow.style.left = e.clientX + 'px';
            cursorGlow.style.top = e.clientY + 'px';
        }, { passive: true });

        /* ========== MOUSE PARALLAX PADA HERO ========== */
        const heroSection = document.getElementById('heroSection');
        document.addEventListener('mousemove', (e) => {
            const layers = document.querySelectorAll('.hero-parallax-layer');
            const cx = window.innerWidth / 2;
            const cy = window.innerHeight / 2;
            const dx = (e.clientX - cx) / cx;
            const dy = (e.clientY - cy) / cy;
            layers.forEach(layer => {
                const speed = parseFloat(layer.dataset.speed || 0.03);
                const tx = dx * speed * 60;
                const ty = dy * speed * 60;
                layer.style.transform = `translate(${tx}px, ${ty}px)`;
            });
        }, { passive: true });

        /* ========== CANVAS PARTIKEL 3D ========== */
        (function() {
            const canvas = document.getElementById('particleCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let W = canvas.width = window.innerWidth;
            let H = canvas.height = window.innerHeight;
            window.addEventListener('resize', () => {
                W = canvas.width = window.innerWidth;
                H = canvas.height = window.innerHeight;
            }, { passive: true });

            const NUM = 55;
            const particles = Array.from({ length: NUM }, () => ({
                x: Math.random() * W,
                y: Math.random() * H,
                z: Math.random() * 800 + 100,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                vz: (Math.random() - 0.5) * 0.8,
                r: Math.random() * 1.5 + 0.5,
                alpha: Math.random() * 0.4 + 0.1,
                hue: Math.random() > 0.7 ? 0 : 355  // merah atau sangat merah
            }));

            let mouseX = W / 2, mouseY = H / 2;
            document.addEventListener('mousemove', e => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            }, { passive: true });

            function drawFrame() {
                ctx.clearRect(0, 0, W, H);
                const fov = 600;
                particles.forEach(p => {
                    p.x += p.vx + (mouseX - W/2) * 0.00008;
                    p.y += p.vy + (mouseY - H/2) * 0.00008;
                    p.z += p.vz;
                    if (p.x < 0) p.x = W;
                    if (p.x > W) p.x = 0;
                    if (p.y < 0) p.y = H;
                    if (p.y > H) p.y = 0;
                    if (p.z < 50) p.z = 900;
                    if (p.z > 900) p.z = 50;
                    const scale = fov / (fov + p.z);
                    const px = (p.x - W/2) * scale + W/2;
                    const py = (p.y - H/2) * scale + H/2;
                    const radius = p.r * scale;
                    const alpha = p.alpha * scale;
                    ctx.beginPath();
                    ctx.arc(px, py, radius, 0, Math.PI * 2);
                    ctx.fillStyle = `hsla(${p.hue}, 85%, 55%, ${alpha})`;
                    ctx.fill();
                });
                // Gambar garis koneksi antar partikel dekat
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const a = particles[i], b = particles[j];
                        const distSq = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
                        if (distSq < 14000) {
                            const alpha = (1 - distSq / 14000) * 0.06;
                            ctx.beginPath();
                            ctx.moveTo(a.x, a.y);
                            ctx.lineTo(b.x, b.y);
                            ctx.strokeStyle = `rgba(220, 38, 38, ${alpha})`;
                            ctx.lineWidth = 0.5;
                            ctx.stroke();
                        }
                    }
                }
                requestAnimationFrame(drawFrame);
            }
            drawFrame();
        })();

        /* ========== 3D TILT PADA FEATURE CARDS ========== */
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const cx = rect.left + rect.width / 2;
                const cy = rect.top + rect.height / 2;
                const dx = (e.clientX - cx) / (rect.width / 2);
                const dy = (e.clientY - cy) / (rect.height / 2);
                card.style.transform = `perspective(800px) rotateY(${dx * 10}deg) rotateX(${-dy * 8}deg) translateY(-8px) scale(1.02)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });

        /* ========== DEKORASI PARTIKEL MENGAMBANG ========== */
        (function() {
            for (let i = 0; i < 8; i++) {
                const d = document.createElement('div');
                d.className = 'deco-particle';
                const size = Math.random() * 4 + 2;
                d.style.cssText = [
                    `width:${size}px`, `height:${size}px`,
                    `background:rgba(220,38,38,${Math.random()*0.3+0.1})`,
                    `left:${Math.random()*100}%`,
                    `animation-duration:${Math.random()*12+10}s`,
                    `animation-delay:${Math.random()*8}s`
                ].join(';');
                document.body.appendChild(d);
            }
        })();
        /* ========== FLUID CIRCULAR MENU ========== */
        (function() {
            const fluidMenu = document.getElementById('fluidMenu');
            const fluidTrigger = document.getElementById('fluidTrigger');
            const fluidBackdrop = document.getElementById('fluidBackdrop');
            if (!fluidMenu || !fluidTrigger) return;

            function toggleFluidMenu() {
                fluidMenu.classList.toggle('open');
                fluidBackdrop.classList.toggle('active');
            }
            function closeFluidMenu() {
                fluidMenu.classList.remove('open');
                fluidBackdrop.classList.remove('active');
            }

            fluidTrigger.addEventListener('click', toggleFluidMenu);
            fluidBackdrop.addEventListener('click', closeFluidMenu);

            // Close when a menu item is clicked
            fluidMenu.querySelectorAll('.fluid-menu-item').forEach(item => {
                item.addEventListener('click', closeFluidMenu);
            });
        })();
    </script>
</body>
</html>
