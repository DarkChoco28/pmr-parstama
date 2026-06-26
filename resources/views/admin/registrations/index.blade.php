@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1;">

    {{-- Header --}}
    <div class="mb-6 flex items-start justify-between flex-wrap gap-4">
        <div>
            <h1 style="color:#fff;font-family:'Sansita', Georgia, serif,Georgia,serif;font-weight:700;font-size:28px;">
                Daftar Pendaftar
            </h1>
            <p style="color:#888;margin-top:4px;font-size:14.4px;">
                PMR PARSTAMA — Total
                <span style="color:#EF4444;font-weight:600;">{{ $registrations->total() }}</span> pendaftar
            </p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            {{-- Export Excel --}}
            <a href="{{ route('admin.registrations.excel', request()->query()) }}" class="btn-action btn-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
                Export Excel
            </a>
            {{-- Clear Data --}}
            <button onclick="openClearModal()" class="btn-action btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
                Hapus Data
            </button>
        </div>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
    <div style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.25);color:#22C55E;padding:12px 16px;border-radius:7.2px;margin-bottom:20px;font-size:14px;display:flex;align-items:center;gap:8px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.25);color:#EF4444;padding:12px 16px;border-radius:7.2px;margin-bottom:20px;font-size:14px;">
        ⚠ {{ session('error') }}
    </div>
    @endif

    <style>
    /* ===== BUTTONS ===== */
    .btn-action {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 18px; border-radius: 7.2px; font-size: 13.5px;
        font-weight: 600; text-decoration: none; cursor: pointer;
        border: 1px solid transparent; transition: background .2s, box-shadow .2s, transform .15s;
        white-space: nowrap;
    }
    .btn-action:hover { transform: translateY(-1px); }
    .btn-green {
        background: rgba(34,197,94,.1); color: #22C55E;
        border-color: rgba(34,197,94,.3);
    }
    .btn-green:hover { background: rgba(34,197,94,.2); box-shadow: 0 0 12px rgba(34,197,94,.15); }
    .btn-danger {
        background: rgba(239,68,68,.1); color: #EF4444;
        border-color: rgba(239,68,68,.3);
    }
    .btn-danger:hover { background: rgba(239,68,68,.2); box-shadow: 0 0 12px rgba(239,68,68,.15); }
    .btn-blue {
        background: rgba(59,130,246,.1); color: #60A5FA;
        border-color: rgba(59,130,246,.25);
    }
    .btn-blue:hover { background: rgba(59,130,246,.2); box-shadow: 0 0 8px rgba(59,130,246,.15); }

    .filter-wrap {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
        margin-bottom: 20px;
    }
    .filter-field,
    .filter-select {
        width: 100%;
        min-height: 42px;
        padding: 10px 12px;
        border-radius: 7px;
        border: 1px solid rgba(255,255,255,.1);
        background: rgba(255,255,255,.04);
        color: #E0E0E0;
        outline: none;
    }
    .filter-select option { background: #111; color: #E0E0E0; }
    .filter-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    /* ===== TABEL ===== */
    .reg-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .reg-table thead tr { border-bottom: 1px solid rgba(255,255,255,.08); }
    .reg-table th {
        padding: 12px 16px; text-align: left; color: #666;
        font-weight: 600; font-size: 11.5px;
        text-transform: uppercase; letter-spacing: .5px; white-space: nowrap;
    }
    .reg-table tbody tr {
        border-bottom: 1px solid rgba(255,255,255,.04);
        transition: background .15s;
    }
    .reg-table tbody tr:hover { background: rgba(255,255,255,.03); }
    .reg-table td { padding: 12px 16px; color: #D0D0D0; vertical-align: middle; }

    /* ===== BADGE ===== */
    .badge {
        display: inline-block; padding: 3px 10px; border-radius: 50px;
        font-size: 11.5px; font-weight: 600; text-transform: capitalize;
    }
    .badge-pending  { background: rgba(245,158,11,.1);  color: #F59E0B; border: 1px solid rgba(245,158,11,.25); }
    .badge-accepted { background: rgba(34,197,94,.1);   color: #22C55E; border: 1px solid rgba(34,197,94,.25); }
    .badge-rejected { background: rgba(239,68,68,.1);   color: #EF4444; border: 1px solid rgba(239,68,68,.25); }

    /* ===== SELECT STATUS ===== */
    .status-select {
        background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
        color: #E0E0E0; border-radius: 6px; padding: 5px 8px; font-size: 12.5px;
        cursor: pointer; outline: none; transition: border-color .2s;
    }
    .status-select:hover { border-color: rgba(220,38,38,.4); }
    .status-select option { background: #1a1a1a; color: #E0E0E0; }

    /* ===== TOMBOL HAPUS BARIS ===== */
    .btn-delete-row {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 6px; cursor: pointer;
        background: rgba(239,68,68,.08); border: 1px solid rgba(239,68,68,.2);
        color: #EF4444; transition: background .2s, box-shadow .2s;
        flex-shrink: 0;
    }
    .btn-delete-row:hover {
        background: rgba(239,68,68,.2);
        box-shadow: 0 0 8px rgba(239,68,68,.2);
    }

    /* ===== MODAL ===== */
    .modal-overlay {
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,.7); backdrop-filter: blur(4px);
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
        opacity: 0; pointer-events: none; transition: opacity .25s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal-box {
        background: #111; border: 1px solid rgba(255,255,255,.1);
        border-radius: 12px; padding: 32px 28px; width: 100%; max-width: 460px;
        transform: translateY(20px); transition: transform .25s ease;
        box-shadow: 0 24px 64px rgba(0,0,0,.6);
    }
    .modal-overlay.open .modal-box { transform: translateY(0); }
    .modal-title {
        font-family: 'Sansita', Georgia, serif;
        font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 8px;
    }
    .modal-desc { color: #888; font-size: 14px; line-height: 1.6; margin-bottom: 24px; }
    .modal-options { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
    .modal-option {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px; border-radius: 8px; cursor: pointer;
        border: 1.5px solid rgba(255,255,255,.08);
        background: rgba(255,255,255,.03);
        transition: border-color .2s, background .2s;
    }
    .modal-option:has(input:checked) {
        border-color: #EF4444;
        background: rgba(239,68,68,.06);
    }
    .modal-option input[type="radio"] { accent-color: #EF4444; width: 16px; height: 16px; flex-shrink: 0; }
    .modal-option-label { font-size: 14px; font-weight: 600; color: #E0E0E0; }
    .modal-option-desc  { font-size: 12px; color: #666; margin-top: 2px; }
    .modal-warning {
        background: rgba(245,158,11,.06); border: 1px solid rgba(245,158,11,.25);
        border-radius: 8px; padding: 12px 14px; margin-bottom: 20px;
        color: #F59E0B; font-size: 13px; display: flex; gap: 8px; align-items: flex-start;
    }
    .modal-footer { display: flex; gap: 10px; justify-content: flex-end; }
    .modal-confirm-input {
        width: 100%; background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.1); border-radius: 6px;
        color: #fff; padding: 9px 12px; font-size: 13px; outline: none;
        margin-bottom: 16px; transition: border-color .2s;
    }
    .modal-confirm-input:focus { border-color: #EF4444; }
    .modal-confirm-input::placeholder { color: #555; }

    /* ===== PAGINATION ===== */
    nav[aria-label="Pagination"] span,
    nav[aria-label="Pagination"] a {
        background: rgba(255,255,255,.04) !important;
        border-color: rgba(255,255,255,.08) !important;
        color: #888 !important;
    }
    nav[aria-label="Pagination"] a:hover {
        background: rgba(220,38,38,.08) !important;
        color: #EF4444 !important;
    }
    nav[aria-label="Pagination"] span[aria-current] {
        background: rgba(220,38,38,.15) !important;
        color: #EF4444 !important;
        border-color: rgba(220,38,38,.3) !important;
    }
    </style>

    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:7.2px;padding:20px;margin-bottom:20px;">
        <form method="GET" action="{{ route('admin.registrations.index') }}">
            <div class="filter-wrap">
                <input
                    type="text"
                    name="search"
                    class="filter-field"
                    placeholder="Cari nama, email, atau WhatsApp"
                    value="{{ $filters['search'] ?? '' }}"
                >

                <select name="status" class="filter-select">
                    <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ ($filters['status'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ ($filters['status'] ?? '') === 'accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ ($filters['status'] ?? '') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>

                <select name="class" class="filter-select">
                    <option value="">Semua Kelas</option>
                    @foreach(($filterOptions['classes'] ?? []) as $classOption)
                        <option value="{{ $classOption }}" {{ ($filters['class'] ?? '') === $classOption ? 'selected' : '' }}>{{ $classOption }}</option>
                    @endforeach
                </select>

                <select name="major" class="filter-select">
                    <option value="">Semua Jurusan</option>
                    @foreach(($filterOptions['majors'] ?? []) as $majorOption)
                        <option value="{{ $majorOption }}" {{ ($filters['major'] ?? '') === $majorOption ? 'selected' : '' }}>{{ $majorOption }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-action btn-blue">Terapkan Filter</button>
                <a href="{{ route('admin.registrations.index') }}" class="btn-action">Reset</a>
                <span style="color:#888;font-size:13px;">Menampilkan {{ $registrations->count() }} dari total {{ $registrations->total() }} pendaftar</span>
            </div>
        </form>
    </div>

    {{-- ===== TABEL ===== --}}
    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:7.2px;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="reg-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>WhatsApp</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $reg)
                    <tr id="row-{{ $reg->id }}">
                        <td style="color:#555;">{{ $reg->id }}</td>
                        <td style="color:#fff;font-weight:500;">{{ $reg->full_name }}</td>
                        <td>{{ $reg->class }}</td>
                        <td style="color:#888;">{{ $reg->major }}</td>
                        <td style="color:#888;font-size:13px;">{{ $reg->whatsapp }}</td>
                        <td style="color:#666;font-size:13px;">{{ $reg->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-{{ $reg->status }}">{{ $reg->status }}</span>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:nowrap;">

                                {{-- PDF --}}
                                <a href="{{ route('admin.registrations.pdf', $reg->id) }}"
                                   class="btn-action btn-blue"
                                   style="padding:5px 10px;font-size:12px;"
                                   target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    PDF
                                </a>

                                {{-- Ubah Status --}}
                                <form action="{{ route('admin.registrations.status', $reg->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <select name="status" class="status-select" onchange="confirmStatus(this)">
                                        <option value="pending"  {{ $reg->status === 'pending'  ? 'selected' : '' }}>Pending</option>
                                        <option value="accepted" {{ $reg->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $reg->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>

                                {{-- Hapus baris --}}
                                <button class="btn-delete-row"
                                    data-id="{{ $reg->id }}"
                                    data-name="{{ $reg->full_name }}"
                                    onclick="confirmDelete(this.dataset.id, this.dataset.name)"
                                    title="Hapus pendaftar ini">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                    </svg>
                                </button>

                                {{-- Form delete tersembunyi --}}
                                <form id="delete-form-{{ $reg->id }}"
                                      action="{{ route('admin.registrations.destroy', $reg->id) }}"
                                      method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;color:#555;padding:40px 0;">
                            Belum ada data pendaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($registrations->hasPages())
        <div style="padding:16px 20px;border-top:1px solid rgba(255,255,255,.04);">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>

</div>

{{-- ===== MODAL HAPUS BULK ===== --}}
<div class="modal-overlay" id="clearModal">
    <div class="modal-box">
        <div class="modal-title">🗑 Hapus Data Pendaftar</div>
        <p class="modal-desc">Pilih data yang ingin dihapus. Aksi ini <strong style="color:#fff;">tidak dapat dibatalkan</strong>.</p>

        <form id="clearForm" action="{{ route('admin.registrations.destroyBulk') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-options">
                <label class="modal-option">
                    <input type="radio" name="filter" value="pending" checked>
                    <div>
                        <div class="modal-option-label">Hapus Data Pending</div>
                        <div class="modal-option-desc">Hanya hapus pendaftar dengan status <span style="color:#F59E0B;">pending</span> — cocok untuk bersihkan data percobaan</div>
                    </div>
                </label>
                <label class="modal-option">
                    <input type="radio" name="filter" value="rejected">
                    <div>
                        <div class="modal-option-label">Hapus Data Ditolak</div>
                        <div class="modal-option-desc">Hanya hapus pendaftar dengan status <span style="color:#EF4444;">rejected</span></div>
                    </div>
                </label>
                <label class="modal-option">
                    <input type="radio" name="filter" value="all">
                    <div>
                        <div class="modal-option-label" style="color:#EF4444;">⚠ Hapus Semua Data</div>
                        <div class="modal-option-desc">Menghapus <strong style="color:#EF4444;">seluruh</strong> data pendaftar termasuk yang sudah diterima</div>
                    </div>
                </label>
            </div>

            <div class="modal-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Sebaiknya <strong>export Excel dulu</strong> sebelum menghapus, agar data tetap tersimpan sebagai backup.
            </div>

            <label style="font-size:13px;color:#888;display:block;margin-bottom:6px;">
                Ketik <strong style="color:#fff;">HAPUS</strong> untuk konfirmasi:
            </label>
            <input type="text" id="confirmText" class="modal-confirm-input" placeholder="Ketik HAPUS di sini...">

            <div class="modal-footer">
                <button type="button" onclick="closeClearModal()"
                    style="padding:9px 20px;border-radius:7.2px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#aaa;font-size:13.5px;font-weight:600;cursor:pointer;">
                    Batal
                </button>
                <button type="button" id="confirmClearBtn" onclick="submitClear()"
                    style="padding:9px 20px;border-radius:7.2px;background:#991b1b;border:1px solid rgba(239,68,68,.4);color:#fff;font-size:13.5px;font-weight:600;cursor:pointer;opacity:.4;pointer-events:none;transition:opacity .2s;">
                    Hapus Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ── Ubah status dengan konfirmasi ──────────────────────────────
    function confirmStatus(select) {
        const label = { pending: 'Pending', accepted: 'Diterima', rejected: 'Ditolak' };
        const newVal = select.value;
        if (confirm('Ubah status menjadi "' + (label[newVal] || newVal) + '"?')) {
            select.closest('form').submit();
        } else {
            const original = select.closest('tr').querySelector('.badge').textContent.trim();
            select.value = original;
        }
    }

    // ── Hapus satu baris ──────────────────────────────────────────
    function confirmDelete(id, name) {
        if (confirm('Hapus data pendaftar "' + name + '"?\n\nAksi ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // ── Modal hapus bulk ──────────────────────────────────────────
    function openClearModal() {
        document.getElementById('confirmText').value = '';
        toggleConfirmBtn();
        document.getElementById('clearModal').classList.add('open');
        setTimeout(() => document.getElementById('confirmText').focus(), 300);
    }

    function closeClearModal() {
        document.getElementById('clearModal').classList.remove('open');
    }

    // Tutup modal kalau klik overlay (bukan box)
    document.getElementById('clearModal').addEventListener('click', function(e) {
        if (e.target === this) closeClearModal();
    });

    // Aktifkan tombol hapus hanya kalau mengetik "HAPUS"
    document.getElementById('confirmText').addEventListener('input', toggleConfirmBtn);
    function toggleConfirmBtn() {
        const val   = document.getElementById('confirmText').value.trim();
        const btn   = document.getElementById('confirmClearBtn');
        const valid = val === 'HAPUS';
        btn.style.opacity       = valid ? '1'    : '.4';
        btn.style.pointerEvents = valid ? 'all'  : 'none';
    }

    function submitClear() {
        if (document.getElementById('confirmText').value.trim() !== 'HAPUS') return;
        document.getElementById('clearForm').submit();
    }

    // Tutup modal dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeClearModal();
    });
</script>
@endpush
