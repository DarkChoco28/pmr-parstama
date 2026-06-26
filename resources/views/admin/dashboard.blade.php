@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1;">

    {{-- Header --}}
    <div class="mb-8 flex items-start justify-between flex-wrap gap-4">
        <div>
            <h1 style="color: #fff; font-family: 'Sansita', Georgia, serif; font-weight: 700; font-size: 28px;">Dashboard Admin</h1>
            <p style="color: #888; margin-top: 4px; font-size: 14.4px;">PMR PARSTAMA — Panel pengelolaan pendaftaran anggota</p>
        </div>
        <div id="toggle-wrap" class="flex items-center gap-3">
            <span id="status-label" class="text-sm font-semibold px-3 py-1 rounded-full">Memuat...</span>
            <button id="toggle-btn" onclick="toggleRegistration()" class="px-4 py-2 rounded-lg font-semibold text-sm text-white transition" style="border-radius: 7.2px; cursor: pointer;">
                Memuat...
            </button>
        </div>
    </div>

    <style>
    /* ===== STAT CARDS ===== */
    /* Animasi hover-only agar tidak menimpa elemen lain saat idle */
    .dashboard-card-3d {
        position: relative;
        isolation: isolate;              /* buat stacking context sendiri */
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        cursor: default;
    }
    .dashboard-card-3d:hover {
        transform: translateY(-6px) rotateX(2deg);
        box-shadow: 0 16px 40px rgba(220,38,38,.15);
    }
    /* Ikon berputar hanya saat hover kartu */
    .dashboard-card-3d:hover .dashboard-icon-3d {
        animation: dashboardIconSpin 1s ease forwards;
    }
    @keyframes dashboardIconSpin {
        0%   { transform: rotateY(0deg) scale(1); }
        50%  { transform: rotateY(180deg) scale(1.15); }
        100% { transform: rotateY(360deg) scale(1); }
    }
    @keyframes dashboardGlowPulse {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(1.08); }
    }
    .dashboard-glow-3d {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(220,38,38,.08) 0%, transparent 70%);
        animation: dashboardGlowPulse 4s ease-in-out infinite;
        pointer-events: none;
        z-index: 0;
    }
    .dashboard-icon-3d {
        position: relative; z-index: 2;
        transition: transform 0.3s ease;
    }
    .dashboard-card-3d .card-content {
        position: relative; z-index: 2;
    }

    /* ===== ICON BAR ===== */
    .icon-bar-admin {
        display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;
        background: rgba(255,255,255,.03); padding: 0.75rem 1rem; border-radius: 7.2px;
        border: 1px solid rgba(255,255,255,.06);
        margin-bottom: 2rem;
    }
    .icon-bar-item-admin {
        position: relative; display: inline-flex; height: 40px; align-items: center;
        border-radius: 7.2px; background: rgba(255,255,255,.04); color: #888;
        cursor: pointer; text-decoration: none; border: 1px solid rgba(255,255,255,.08);
        transition: background 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s, max-width 0.4s;
        overflow: hidden;
        max-width: 40px;   /* collapsed by default */
    }
    .icon-bar-item-admin:hover {
        background: rgba(220,38,38,.08); color: #EF4444;
        border-color: rgba(220,38,38,.3);
        box-shadow: 0 0 12px rgba(220,38,38,.1);
        max-width: 220px;  /* expand on hover */
    }
    .icon-bar-icon-admin {
        display: flex; width: 40px; height: 40px; flex-shrink: 0;
        align-items: center; justify-content: center;
    }
    .icon-bar-icon-admin svg { width: 18px; height: 18px; stroke-width: 2; }
    .icon-bar-label-admin {
        white-space: nowrap; font-size: 14px; font-weight: 500;
        opacity: 0;
        padding-right: 0;
        transition: opacity 0.25s ease 0.1s, padding-right 0.3s ease;
    }
    .icon-bar-item-admin:hover .icon-bar-label-admin {
        opacity: 1;
        padding-right: 14px;
    }

    /* ===== RECENT TABLE ===== */
    #recent-list table { border-collapse: collapse; }
    #recent-list tr { transition: background 0.2s; }
    #recent-list tbody tr:hover { background: rgba(255,255,255,.03); }
    </style>

    {{-- Stats Cards — overflow:hidden dihapus agar animasi hover tidak terpotong --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        {{-- Total Pendaftar --}}
        <div class="p-6 dashboard-card-3d" style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px;">
            <div class="dashboard-glow-3d"></div>
            <div class="card-content flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #888;">Total Pendaftar</p>
                    <p class="text-3xl font-bold mt-1" style="color: #fff; font-family: 'Sansita', Georgia, serif;" id="total-registrations">—</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center text-2xl dashboard-icon-3d" style="background: rgba(220,38,38,.1); border-radius: 7.2px;">📋</div>
            </div>
        </div>

        {{-- Pendaftar Hari Ini --}}
        <div class="p-6 dashboard-card-3d" style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px;">
            <div class="dashboard-glow-3d"></div>
            <div class="card-content flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #888;">Pendaftar Hari Ini</p>
                    <p class="text-3xl font-bold mt-1" style="color: #fff; font-family: 'Sansita', Georgia, serif;" id="today-registrations">—</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center text-2xl dashboard-icon-3d" style="background: rgba(220,38,38,.1); border-radius: 7.2px;">📅</div>
            </div>
        </div>

        {{-- Menunggu Verifikasi --}}
        <div class="p-6 dashboard-card-3d" style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px;">
            <div class="dashboard-glow-3d"></div>
            <div class="card-content flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #888;">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold mt-1" style="color: #F59E0B; font-family: 'Sansita', Georgia, serif;" id="pending-registrations">—</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center text-2xl dashboard-icon-3d" style="background: rgba(245,158,11,.08); border-radius: 7.2px;">⏳</div>
            </div>
        </div>

        {{-- Diterima --}}
        <div class="p-6 dashboard-card-3d" style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px;">
            <div class="dashboard-glow-3d"></div>
            <div class="card-content flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #888;">Diterima</p>
                    <p class="text-3xl font-bold mt-1" style="color: #22C55E; font-family: 'Sansita', Georgia, serif;" id="accepted-registrations">—</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center text-2xl dashboard-icon-3d" style="background: rgba(34,197,94,.08); border-radius: 7.2px;">✅</div>
            </div>
        </div>

    </div>

    {{-- Quick Actions --}}
    <h2 class="text-lg font-semibold mb-4" style="color: #fff; font-family: 'Sansita', Georgia, serif; font-weight: 700;">Aksi Cepat</h2>
    <div class="icon-bar-admin">
        <a href="{{ route('admin.registrations.index') }}" class="icon-bar-item-admin">
            <span class="icon-bar-icon-admin">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" x2="19" y1="8" y2="14"/>
                    <line x1="22" x2="16" y1="11" y2="11"/>
                </svg>
            </span>
            <span class="icon-bar-label-admin">Kelola Pendaftar</span>
        </a>
        <a href="{{ route('admin.registrations.excel') }}" class="icon-bar-item-admin">
            <span class="icon-bar-icon-admin">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
            </span>
            <span class="icon-bar-label-admin">Export Excel</span>
        </a>
        <a href="{{ url('/') }}" class="icon-bar-item-admin">
            <span class="icon-bar-icon-admin">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="2" x2="22" y1="12" y2="12"/>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
            </span>
            <span class="icon-bar-label-admin">Lihat Website</span>
        </a>
    </div>

    {{-- Recent Registrations --}}
    <div class="p-6" style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 7.2px;">
        <h2 class="text-lg font-semibold mb-4" style="color: #fff; font-family: 'Sansita', Georgia, serif; font-weight: 700;">Pendaftar Terbaru</h2>
        <div id="recent-list" style="color: #888; font-size: 14px;">Memuat data...</div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    fetch('{{ route("admin.dashboard.stats") }}')
        .then(res => res.json())
        .then(json => {
            // ApiResponse membungkus data dalam { success, message, data: { ... } }
            // jadi kita ambil dari json.data
            const data = json.data;

            document.getElementById('total-registrations').textContent = data.total;
            document.getElementById('today-registrations').textContent = data.today;
            document.getElementById('pending-registrations').textContent = data.pending;
            document.getElementById('accepted-registrations').textContent = data.accepted || 0;
            updateToggleUI(data.registration_open);

            const list = document.getElementById('recent-list');
            if (data.recent && data.recent.length > 0) {
                // Pakai DOM API agar aman dari XSS
                const wrapper = document.createElement('div');
                wrapper.className = 'overflow-x-auto';
                const table = document.createElement('table');
                table.className = 'w-full text-sm';

                const thead = document.createElement('thead');
                const headerRow = document.createElement('tr');
                headerRow.setAttribute('style', 'border-bottom: 1px solid rgba(255,255,255,.06); color: #888;');
                headerRow.className = 'text-left';
                ['Nama', 'Kelas', 'Status'].forEach(text => {
                    const th = document.createElement('th');
                    th.className = 'py-2 pr-4';
                    th.textContent = text;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);
                table.appendChild(thead);

                const tbody = document.createElement('tbody');
                data.recent.forEach(r => {
                    const statusColor = r.status === 'accepted' ? '#22C55E' : (r.status === 'rejected' ? '#EF4444' : '#F59E0B');
                    const tr = document.createElement('tr');
                    tr.setAttribute('style', 'border-bottom: 1px solid rgba(255,255,255,.04);');

                    const tdName = document.createElement('td');
                    tdName.className = 'py-2 pr-4 font-medium';
                    tdName.setAttribute('style', 'color: #E0E0E0;');
                    tdName.textContent = r.full_name;

                    const tdClass = document.createElement('td');
                    tdClass.className = 'py-2 pr-4';
                    tdClass.setAttribute('style', 'color: #888;');
                    tdClass.textContent = r.class || '-';

                    const tdStatus = document.createElement('td');
                    tdStatus.className = 'py-2 capitalize';
                    tdStatus.setAttribute('style', 'color: ' + statusColor + ';');
                    tdStatus.textContent = r.status;

                    tr.appendChild(tdName);
                    tr.appendChild(tdClass);
                    tr.appendChild(tdStatus);
                    tbody.appendChild(tr);
                });
                table.appendChild(tbody);
                wrapper.appendChild(table);
                list.innerHTML = '';
                list.appendChild(wrapper);
            } else {
                const p = document.createElement('p');
                p.setAttribute('style', 'color: #555; text-align: center; padding: 16px 0;');
                p.textContent = 'Belum ada pendaftar.';
                list.innerHTML = '';
                list.appendChild(p);
            }
        })
        .catch(() => {
            document.getElementById('recent-list').innerHTML = '<p style="color: #EF4444;">Gagal memuat data.</p>';
        });

    function updateToggleUI(isOpen) {
        const label = document.getElementById('status-label');
        const btn   = document.getElementById('toggle-btn');
        if (isOpen) {
            label.textContent = 'DIBUKA';
            label.style.cssText = 'background:rgba(34,197,94,.1);color:#22C55E;font-size:.875rem;font-weight:600;padding:4px 12px;border-radius:9999px;';
            btn.textContent = 'Tutup Pendaftaran';
            btn.style.background = '#EF4444';
        } else {
            label.textContent = 'DITUTUP';
            label.style.cssText = 'background:rgba(239,68,68,.1);color:#EF4444;font-size:.875rem;font-weight:600;padding:4px 12px;border-radius:9999px;';
            btn.textContent = 'Buka Pendaftaran';
            btn.style.background = '#DC2626';
        }
        btn.disabled = false;
    }

    function toggleRegistration() {
        const btn = document.getElementById('toggle-btn');
        btn.disabled = true;
        btn.textContent = 'Memproses...';

        fetch('{{ route("admin.dashboard.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        })
        .then(res => res.json())
        .then(json => updateToggleUI(json.data.registration_open))  // ambil dari json.data
        .catch(() => {
            alert('Gagal mengubah status pendaftaran.');
            btn.disabled = false;
            btn.textContent = 'Coba Lagi';
        });
    }
</script>
@endpush
