<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran - {{ $registration->full_name }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.5; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #b5070c; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #b5070c; font-size: 24px; }
        .header p { margin: 5px 0 0; font-size: 16px; color: #555; }
        .section-title { background: #f4f4f4; padding: 8px; font-weight: bold; margin-top: 20px; border-left: 4px solid #b5070c; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; vertical-align: top; }
        th { width: 35%; background: #fafafa; color: #555; font-weight: normal; }
        td { width: 65%; font-weight: bold; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>PMR PARSTAMA</h1>
        <p>Formulir Pendaftaran Anggota</p>
    </div>

    <table>
        <tr>
            <th>Nomor Pendaftaran</th>
            <td>#{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <th>Tanggal Mendaftar</th>
            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td style="text-transform: uppercase;">{{ $registration->status }}</td>
        </tr>
    </table>

    <div class="section-title">Data Diri</div>
    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $registration->full_name }}</td>
        </tr>
        <tr>
            <th>Nama Panggilan</th>
            <td>{{ $registration->nickname ?: '-' }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $registration->birth_place }}, {{ \Carbon\Carbon::parse($registration->birth_date)->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="section-title">Kontak & Sekolah</div>
    <table>
        <tr>
            <th>WhatsApp</th>
            <td>{{ $registration->whatsapp }}</td>
        </tr>
        <tr>
            <th>Alamat Lengkap</th>
            <td>{{ $registration->address }}</td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>{{ $registration->city ?: '-' }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $registration->class }}</td>
        </tr>
        <tr>
            <th>Jurusan</th>
            <td>{{ $registration->major }}</td>
        </tr>
    </table>

    <div class="section-title">Motivasi & Pengalaman</div>
    <table>
        <tr>
            <th>Alasan Bergabung</th>
            <td style="font-weight: normal; font-style: italic;">"{{ $registration->motivation }}"</td>
        </tr>
        <tr>
            <th>Pengalaman Organisasi</th>
            <td style="font-weight: normal;">{{ $registration->organization_experience ?: 'Tidak ada / tidak diisi' }}</td>
        </tr>
    </table>

    <div class="footer">
        Dicetak pada {{ date('d/m/Y H:i') }} | PMR PARSTAMA
    </div>

</body>
</html>
