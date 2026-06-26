<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran - PMR PARSTAMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', Arial, Helvetica, sans-serif;
            background: #0f0f0f;
            color: #f5f5f5;
            background-image:
                radial-gradient(circle at top left, rgba(220, 38, 38, 0.14), transparent 30%),
                radial-gradient(circle at bottom right, rgba(220, 38, 38, 0.12), transparent 35%);
        }
        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 760px;
            background: rgba(255, 255, 255, 0.035);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(18px);
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto;
            height: 2px;
            background: linear-gradient(90deg, transparent, #dc2626, transparent);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 22px;
        }
        .brand-logo-wrap {
            width: 72px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .brand-text {
            font-family: 'Sansita', Georgia, serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(220, 38, 38, 0.08);
            border: 1px solid rgba(220, 38, 38, 0.2);
            color: #f87171;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }
        .title {
            margin: 0 0 8px;
            font-size: 34px;
            font-family: 'Sansita', Georgia, serif;
        }
        .subtitle {
            margin: 0 0 24px;
            color: #b0b0b0;
            line-height: 1.6;
            max-width: 650px;
        }
        .top-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }
        .top-links a,
        .actions a,
        button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid transparent;
        }
        .btn-primary,
        button {
            background: linear-gradient(135deg, #dc2626, #991b1b);
            color: #fff;
        }
        .btn-secondary {
            color: #f5f5f5;
            border-color: rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.03);
        }
        form {
            display: grid;
            gap: 16px;
        }
        .grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #d4d4d4;
        }
        input {
            width: 100%;
            min-height: 44px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
        }
        .error-list,
        .result-card {
            margin-top: 20px;
            padding: 18px;
            border-radius: 12px;
        }
        .error-list {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #fca5a5;
        }
        .result-card {
            background: rgba(255, 255, 255, 0.045);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            text-transform: capitalize;
            margin-bottom: 12px;
        }
        .status-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
        }
        .status-accepted {
            background: rgba(34, 197, 94, 0.12);
            color: #4ade80;
        }
        .status-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
        }
        .meta {
            display: grid;
            gap: 10px;
            margin-top: 14px;
        }
        .meta-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        .meta-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .meta-label {
            color: #b0b0b0;
        }
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .not-found {
            color: #d4d4d4;
            line-height: 1.7;
        }
        @media (max-width: 640px) {
            .page {
                padding: 16px;
            }
            .card {
                padding: 24px 18px;
                border-radius: 16px;
            }
            .title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="card">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-logo-wrap">
                <img src="{{ asset('parstama_logo.png') }}" alt="PMR PARSTAMA">
            </span>
            <span class="brand-text">PMR PARSTAMA</span>
        </a>

        <div class="top-links">
            <a href="{{ url('/') }}" class="btn-secondary">Kembali ke Beranda</a>
            <a href="{{ route('registration.create') }}" class="btn-primary">Daftar Sekarang</a>
        </div>

        <div class="badge">Status Registration</div>
        <h1 class="title">Cek Status Pendaftaran</h1>
        <p class="subtitle">Masukkan nomor WhatsApp dan tanggal lahir yang digunakan saat mendaftar untuk melihat status pendaftaran ekstrakurikuler PMR PARSTAMA.</p>

        @if($errors->any())
            <div class="error-list">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('registration.status.find') }}">
            @csrf
            <div class="grid">
                <div>
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <input
                        id="whatsapp"
                        name="whatsapp"
                        type="text"
                        inputmode="numeric"
                        placeholder="08xxxxxxxxxx"
                        value="{{ old('whatsapp', $searchInput['whatsapp'] ?? '') }}"
                        required
                    >
                </div>
                <div>
                    <label for="birth_date">Tanggal Lahir</label>
                    <input
                        id="birth_date"
                        name="birth_date"
                        type="date"
                        value="{{ old('birth_date', $searchInput['birth_date'] ?? '') }}"
                        required
                    >
                </div>
            </div>
            <div>
                <button type="submit">Cek Status Sekarang</button>
            </div>
        </form>

        @if(($searched ?? false) && isset($registration) && $registration)
            <div class="result-card">
                <div class="status-badge status-{{ $registration->status }}">
                    Status: {{ $registration->status }}
                </div>
                <div><strong>{{ $registration->full_name }}</strong></div>
                <div style="margin-top: 8px; color: #d4d4d4; line-height: 1.7;">
                    @if($registration->status === 'accepted')
                        Selamat, pendaftaran Anda dinyatakan diterima. Silakan pantau informasi lanjutan dari panitia PMR PARSTAMA.
                    @elseif($registration->status === 'rejected')
                        Pendaftaran Anda saat ini dinyatakan belum lolos. Jika membutuhkan klarifikasi, silakan hubungi panitia.
                    @else
                        Pendaftaran Anda sudah tercatat dan sedang menunggu proses verifikasi panitia.
                    @endif
                </div>

                <div class="meta">
                    <div class="meta-row">
                        <span class="meta-label">Kelas</span>
                        <span>{{ $registration->class }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Jurusan</span>
                        <span>{{ $registration->major }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Tanggal Daftar</span>
                        <span>{{ $registration->created_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        @elseif(($searched ?? false) && isset($registration) && !$registration)
            <div class="result-card not-found">
                Data pendaftaran tidak ditemukan. Pastikan nomor WhatsApp dan tanggal lahir yang dimasukkan sama seperti saat mendaftar.
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('registration.create') }}" class="btn-primary">Isi Form Pendaftaran</a>
            <a href="https://wa.me/6281932781179?text=Halo%20PARSTAMA,%20saya%20ingin%20bertanya%20tentang%20status%20pendaftaran." target="_blank" rel="noopener" class="btn-secondary">Hubungi Panitia</a>
        </div>
    </div>
</div>
</body>
</html>
