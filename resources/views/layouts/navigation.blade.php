<nav x-data="{ open: false }" style="background: rgba(10,10,10,.9); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,.06); position: relative; z-index: 100;">
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
            position: absolute; width: 12px; height: 12px; opacity: 0.08;
            will-change: transform;
        }
        .nav-3d-cross svg { width: 100%; height: 100%; }
        .nav-3d-cross:nth-child(1) { top: 50%; left: 20%; animation: navCrossFloat1 8s ease-in-out infinite; }
        .nav-3d-cross:nth-child(2) { top: 30%; left: 45%; animation: navCrossFloat2 10s ease-in-out infinite 1s; }
        .nav-3d-cross:nth-child(3) { top: 60%; left: 70%; animation: navCrossFloat1 9s ease-in-out infinite 2s; }
        .nav-3d-cross:nth-child(4) { top: 40%; left: 85%; animation: navCrossFloat2 11s ease-in-out infinite .5s; }
        .admin-logo-wrap {
            width: 80px; height: 80px; position: relative;
            display: flex; align-items: center; justify-content: center;
        }
        .admin-nav-logo {
            height: 100%; width: 100%; object-fit: contain;
        }

        .nav-link-admin {
            display: inline-flex; align-items: center; padding: 4px 4px 4px 4px;
            border-bottom: 2px solid transparent;
            font-size: 14px; font-weight: 500; line-height: 20px;
            transition: color 0.15s, border-color 0.15s;
            text-decoration: none; color: #888;
        }
        .nav-link-admin:hover { color: #ccc; }
        .nav-link-admin[data-active="true"] { color: #fff; border-bottom-color: #DC2626; }

        .nav-link-resp {
            display: block; padding: 8px 16px 8px 12px;
            border-left: 4px solid transparent;
            font-size: 16px; font-weight: 500;
            transition: color 0.15s, background 0.15s, border-color 0.15s;
            text-decoration: none; color: #888;
        }
        .nav-link-resp:hover { color: #ccc; }
        .nav-link-resp[data-active="true"] {
            color: #fff; border-left-color: #DC2626;
            background: rgba(220,38,38,.06);
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position: relative;">
        {{-- 3D floating Red Cross symbols in navbar --}}
        <div class="nav-3d-crosses">
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
            <div class="nav-3d-cross"><svg viewBox="0 0 24 24" fill="#DC2626"><rect x="9" y="2" width="6" height="20" rx="1"/><rect x="2" y="9" width="20" height="6" rx="1"/></svg></div>
        </div>
        <div class="flex justify-between h-20" style="position: relative; z-index: 1;">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 no-underline">
                        <div class="admin-logo-wrap">
                            <img src="{{ asset('parstama_logo.png') }}" alt="PMR" class="admin-nav-logo">
                        </div>
                        <span style="font-family: 'Sansita', Georgia, serif; font-weight: 700; background: linear-gradient(90deg,#EF4444,#DC2626); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; font-size: 14.4px;">PMR PARSTAMA</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-admin" data-active="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.registrations.index') }}" class="nav-link-admin" data-active="{{ request()->routeIs('admin.registrations.*') ? 'true' : 'false' }}">
                        Pendaftar
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="nav-link-admin">
                        Website
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" id="userDropdown">
                    <button
                        onclick="toggleUserMenu()"
                        style="display:inline-flex;align-items:center;gap:8px;padding:6px 14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:7.2px;color:#aaa;font-size:13.5px;font-weight:500;cursor:pointer;transition:background .2s,border-color .2s;"
                        onmouseover="this.style.background='rgba(255,255,255,.07)';this.style.borderColor='rgba(255,255,255,.15)'"
                        onmouseout="this.style.background='rgba(255,255,255,.04)';this.style.borderColor='rgba(255,255,255,.08)'"
                        id="userMenuBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ Auth::user()->name }}
                        <svg id="userMenuChevron" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition:transform .2s;"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>

                    {{-- Dropdown panel --}}
                    <div id="userMenuPanel"
                         style="display:none;position:absolute;right:0;top:calc(100% + 8px);width:200px;background:#141414;border:1px solid rgba(255,255,255,.1);border-radius:8px;box-shadow:0 16px 40px rgba(0,0,0,.5);overflow:hidden;z-index:9999;">

                        {{-- Info user --}}
                        <div style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.06);">
                            <div style="font-size:13px;font-weight:600;color:#fff;">{{ Auth::user()->name }}</div>
                            <div style="font-size:11.5px;color:#555;margin-top:2px;">{{ Auth::user()->email }}</div>
                        </div>

                        {{-- Profile --}}
                        <a href="{{ route('profile.edit') }}"
                           style="display:flex;align-items:center;gap:10px;padding:10px 16px;color:#ccc;text-decoration:none;font-size:13.5px;transition:background .15s,color .15s;"
                           onmouseover="this.style.background='rgba(255,255,255,.05)';this.style.color='#fff'"
                           onmouseout="this.style.background='transparent';this.style.color='#ccc'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profile
                        </a>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit"
                                style="display:flex;align-items:center;gap:10px;width:100%;padding:10px 16px;background:transparent;border:none;border-top:1px solid rgba(255,255,255,.04);color:#EF4444;font-size:13.5px;cursor:pointer;text-align:left;transition:background .15s;"
                                onmouseover="this.style.background='rgba(239,68,68,.08)'"
                                onmouseout="this.style.background='transparent'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                Log Out
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: #888;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: #0A0A0A; border-top: 1px solid rgba(255,255,255,.06);">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-resp" data-active="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.registrations.index') }}" class="nav-link-resp" data-active="{{ request()->routeIs('admin.registrations.*') ? 'true' : 'false' }}">
                Pendaftar
            </a>
        </div>

        <div class="pt-4 pb-1" style="border-top: 1px solid rgba(255,255,255,.06);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: #E0E0E0;">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm" style="color: #888;">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium transition duration-150 ease-in-out no-underline" style="color: #888;">
                    {{ __('Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block pl-3 pr-4 py-2 text-base font-medium transition duration-150 ease-in-out no-underline" style="color: #888;">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleUserMenu() {
        const panel   = document.getElementById('userMenuPanel');
        const chevron = document.getElementById('userMenuChevron');
        const isOpen  = panel.style.display !== 'none';
        panel.style.display   = isOpen ? 'none' : 'block';
        chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        const panel    = document.getElementById('userMenuPanel');
        if (dropdown && !dropdown.contains(e.target)) {
            panel.style.display = 'none';
            const chevron = document.getElementById('userMenuChevron');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }
    });
</script>
