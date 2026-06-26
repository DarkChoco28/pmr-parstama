# PMR PARSTAMA - Sistem Pendaftaran Anggota

Sistem pendaftaran anggota PMR (Palang Merah Remaja) PARSTAMA SMKN 1 Singosari yang dibangun dengan Laravel 12. Aplikasi ini memudahkan pengelolaan pendaftaran anggota baru dengan fitur lengkap termasuk export data, manajemen status, dan dashboard admin.

## 🚀 Fitur Utama

- **Formulir Pendaftaran Online** - Formulir lengkap dengan validasi
- **Dashboard Admin** - Statistik real-time dan manajemen pendaftaran
- **Kontrol Pendaftaran** - Buka/tutup pendaftaran secara real-time
- **Export Data** - Export ke Excel dan PDF
- **Manajemen Status** - Terima/tolak pendaftar dengan mudah
- **UI Modern** - Antarmuka responsif dengan animasi 3D (Three.js)
- **Testing** - Automated testing dengan Pest PHP

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** - PHP Framework
- **PHP 8.2+** - Bahasa pemrograman
- **SQLite** - Database (default, dapat diganti)
- **Laravel Breeze** - Authentication scaffolding

### Frontend
- **TailwindCSS 4** - CSS Framework
- **Alpine.js** - JavaScript framework ringan
- **Three.js** - 3D graphics untuk animasi hero
- **Motion** - Library animasi
- **Vite** - Build tool

### Libraries
- **barryvdh/laravel-dompdf** - PDF generation
- **maatwebsite/excel** - Excel export
- **Pest PHP** - Testing framework

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js >= 18
- NPM atau Yarn

## 📦 Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/pdfrn.git
   cd pdfrn
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Jalankan server**
   ```bash
   php artisan serve
   ```

7. **Akses aplikasi**
   - Public: `http://localhost:8000`
   - Admin: `http://localhost:8000/admin/dashboard`

## 🔐 Akun Admin Default

Setelah menjalankan seeder, akun admin default:
- **Email:** admin@example.com
- **Password:** password

*Silakan ganti password setelah login pertama.*

## 📁 Struktur Project

```
pdfrn/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controller aplikasi
│   │   ├── Middleware/       # Middleware custom
│   │   └── Requests/         # Form Request validation
│   ├── Models/              # Model Eloquent
│   └── Exports/             # Export classes
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/             # Database seeders
│   └── factories/           # Model factories
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── routes/                 # Route definitions
├── tests/                  # Automated tests
└── config/                 # Application config
```

## 🧪 Testing

Jalankan semua test:
```bash
php artisan test
```

Jalankan test tertentu:
```bash
php artisan test --filter RegistrationTest
```

## 📝 Fitur Detail

### Formulir Pendaftaran
- Data pribadi lengkap (nama, tanggal lahir, alamat)
- Informasi kontak (WhatsApp, email)
- Data akademik (kelas, jurusan)
- Pengalaman organisasi
- Motivasi bergabung
- Riwayat medis (opsional)

### Dashboard Admin
- Statistik pendaftaran (total, hari ini, pending, diterima)
- Daftar pendaftar terbaru
- Toggle buka/tutup pendaftaran
- Quick access ke manajemen pendaftar

### Manajemen Pendaftar
- Lihat semua pendaftar dengan pagination
- Filter berdasarkan status
- Update status (pending/accepted/rejected)
- Hapus individual atau bulk delete
- Export single ke PDF
- Export semua ke Excel

## 🔧 Konfigurasi

### Environment Variables Penting

```env
APP_NAME="PMR PARSTAMA"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=log
```

## 🚀 Deployment

### Ke Production

1. Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`
2. Optimize aplikasi:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```
3. Set permissions:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:
1. Fork repository
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Tambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buka Pull Request

Lihat [CONTRIBUTING.md](CONTRIBUTING.md) untuk detail lebih lanjut.

## 📄 License

Project ini dilisensikan under MIT License.

## 👥 Kontak

- **Developer:** Fizye
- **Institusi:** SMKN 1 Singosari
- **Organisasi:** PMR PARSTAMA

## 🙏 Acknowledgments

- Laravel Framework
- Palang Merah Indonesia
- SMKN 1 Singosari
