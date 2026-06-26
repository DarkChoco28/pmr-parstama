# Kontribusi ke PMR PARSTAMA

Terima kasih atas ketertarikan Anda untuk berkontribusi ke project PMR PARSTAMA! Dokumen ini akan memandu Anda melalui proses kontribusi.

## 📋 Prasyarat

Sebelum berkontribusi, pastikan Anda telah:
- Membaca dan memahami [README.md](README.md)
- Memiliki PHP >= 8.2 terinstall
- Memiliki Composer dan Node.js terinstall
- Memahami dasar Laravel dan PHP

## 🚀 Cara Berkontribusi

### 1. Fork Repository

Fork repository ini ke akun GitHub Anda sendiri.

### 2. Clone Repository

Clone fork Anda ke lokal:

```bash
git clone https://github.com/username/pdfrn.git
cd pdfrn
```

### 3. Setup Development Environment

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run build
```

### 4. Buat Branch Baru

Buat branch baru untuk fitur atau perbaikan yang akan Anda kerjakan:

```bash
git checkout -b nama-fitur-atau-perbaikan
```

### 5. Lakukan Perubahan

Lakukan perubahan yang diperlukan. Pastikan:
- Code mengikuti standar coding Laravel
- Tambahkan test untuk fitur baru
- Update dokumentasi jika diperlukan
- Commit message yang jelas dan deskriptif

### 6. Jalankan Test

Pastikan semua test lulus:

```bash
php artisan test
```

### 7. Commit Perubahan

```bash
git add .
git commit -m "Deskripsi singkat tentang perubahan"
```

### 8. Push ke GitHub

```bash
git push origin nama-fitur-atau-perbaikan
```

### 9. Buat Pull Request

Buka Pull Request dari fork Anda ke repository utama. Berikan deskripsi yang jelas tentang perubahan yang Anda lakukan.

## 📝 Standar Coding

### PHP Code Style

Project ini menggunakan Laravel Pint untuk code formatting. Jalankan sebelum commit:

```bash
./vendor/bin/pint
```

### JavaScript Code Style

Gunakan ESLint untuk JavaScript:

```bash
npm run lint
```

### Naming Conventions

- **Class:** PascalCase (e.g., `RegistrationController`)
- **Method:** camelCase (e.g., `getRegistration`)
- **Variable:** camelCase (e.g., `$registrationData`)
- **Constant:** UPPER_SNAKE_CASE (e.g., `STATUS_PENDING`)

## 🧪 Testing

### Menulis Test

Setiap fitur baru harus memiliki test yang sesuai. Gunakan Pest PHP:

```php
it('can do something', function () {
    // Test code here
});
```

### Menjalankan Test

Jalankan semua test:
```bash
php artisan test
```

Jalankan test tertentu:
```bash
php artisan test --filter RegistrationTest
```

Jalankan test dengan coverage:
```bash
php artisan test --coverage
```

## 📚 Struktur Project

Pastikan Anda memahami struktur project sebelum berkontribusi:

- `app/Http/Controllers/` - Controller aplikasi
- `app/Models/` - Model Eloquent
- `database/migrations/` - Database migrations
- `resources/views/` - Blade templates
- `routes/` - Route definitions
- `tests/` - Automated tests

## 🐛 Melaporkan Bug

Jika Anda menemukan bug:

1. Pastikan bug belum dilaporkan sebelumnya
2. Gunakan issue template yang tersedia
3. Berikan informasi lengkap:
   - Versi PHP dan Laravel
   - Langkah untuk mereproduksi bug
   - Expected behavior vs actual behavior
   - Screenshot jika relevan

## 💡 Menyarankan Fitur

Untuk menyarankan fitur baru:

1. Buka issue baru dengan label `enhancement`
2. Jelaskan fitur yang diinginkan
3. Berikan use case atau contoh penggunaan
4. Diskusikan dengan maintainers sebelum implementasi

## 📖 Dokumentasi

Jika Anda mengubah fitur yang memengaruhi pengguna:
- Update README.md jika diperlukan
- Update komentar code jika diperlukan
- Tambahkan contoh penggunaan jika relevan

## 🤖 Git Commit Messages

Gunakan commit message yang jelas dan deskriptif:

```
feat: tambah fitur export PDF untuk pendaftar
fix: perbaiki validasi pada formulir pendaftaran
docs: update README dengan instruksi instalasi baru
refactor: optimasi query pada dashboard admin
test: tambah test untuk AdminMiddleware
```

## ⚠️ Code Review

Saat Pull Request Anda direview:

- Terima feedback dengan terbuka
- Jelaskan keputusan desain jika ditanya
- Siap untuk melakukan perubahan jika diminta
- Diskusikan jika ada perbedaan pendapat

## 📜 License

Dengan berkontribusi, Anda setuju bahwa kontribusi Anda akan dilisensikan under MIT License yang sama dengan project ini.

## 🙏 Terima Kasih

Terima kasih atas kontribusi Anda! Setiap kontribusi sangat dihargai dan membantu meningkatkan project ini.
