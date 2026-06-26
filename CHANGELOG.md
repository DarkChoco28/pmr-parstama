# Changelog

Semua perubahan penting ke project ini akan didokumentasikan di file ini.

Format ini didasarkan pada [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
dan project ini mematuhi [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Sistem pendaftaran anggota PMR PARSTAMA
- Formulir pendaftaran online dengan validasi lengkap
- Dashboard admin dengan statistik real-time
- Fitur kontrol buka/tutup pendaftaran
- Export data ke Excel menggunakan maatwebsite/excel
- Export data ke PDF menggunakan barryvdh/laravel-dompdf
- Manajemen status pendaftar (pending/accepted/rejected)
- UI modern dengan TailwindCSS 4
- Animasi 3D hero dengan Three.js
- Authentication dengan Laravel Breeze
- Middleware AdminMiddleware untuk proteksi route admin
- Automated testing dengan Pest PHP
- Database seeder untuk admin user default
- Model Registration, Setting, dan User
- Request validation StoreRegistrationRequest

### Changed
- Mengganti README.md default Laravel dengan dokumentasi khusus project
- Menambahkan CONTRIBUTING.md untuk panduan kontribusi

### Security
- Implementasi middleware untuk proteksi route admin
- Validasi input pada formulir pendaftaran

## [1.0.0] - 2024-01-XX

### Added
- Initial release
- Laravel 12 setup
- Basic project structure
- Authentication system
- Registration system
- Admin dashboard
- Export functionality (PDF/Excel)
- Testing setup with Pest PHP

---

## Format Changelog

### Added
- Fitur baru

### Changed
- Perubahan pada fitur yang sudah ada

### Deprecated
- Fitur yang akan dihapus di versi mendatang

### Removed
- Fitur yang sudah dihapus

### Fixed
- Perbaikan bug

### Security
- Perbaikan keamanan
