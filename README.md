SIAKAD - Sistem Informasi Akademik Sederhana
Tugas Besar Web II IF53413

Aplikasi web berbasis Laravel yang mensimulasikan Sistem Informasi Akademik (SIAKAD) sederhana.

SIAKAD adalah aplikasi manajemen akademik yang memungkinkan Admin mengelola data dosen, mahasiswa, mata kuliah, dan jadwal, serta memungkinkan Mahasiswa mengambil dan mengelola KRS secara mandiri.

| Halaman             | Role      | Fungsi                                              |
|---------------------|-----------|-----------------------------------------------------|
| Login               | Semua     | Autentikasi pengguna                                |
| Dashboard Admin     | Admin     | Statistik total data + jadwal terbaru               |
| Dashboard Mahasiswa | Mahasiswa | KRS aktif + jadwal kuliah                           |
| Data Dosen          | Admin     | CRUD data dosen (NIDN, Nama)                        |
| Data Mahasiswa      | Admin     | CRUD mahasiswa + buat akun login                    |
| Mata Kuliah         | Admin     | CRUD mata kuliah (kode, nama, SKS)                  |
| Jadwal Perkuliahan  | Admin     | CRUD jadwal (MK, Dosen, Kelas, Hari, Jam)           |
| Jadwal (Lihat)      | Mahasiswa | Melihat & filter jadwal perkuliahan                 |
| KRS Semua           | Admin     | Lihat semua KRS + filter per mahasiswa + export PDF |
| KRS Saya            | Mahasiswa | Ambil/drop mata kuliah + export KRS PDF             |

| Role        | Email                 | Password |
|-------------|-----------------------|----------|
| Admin       | admin@siakad.com      | password |
| Mahasiswa 1 | andi@mhs.siakad.com   | password |
| Mahasiswa 2 | budi@mhs.siakad.com   | password |
| Mahasiswa 3 | citra@mhs.siakad.com  | password |


Teknologi
- **Framework**: Laravel 12 + Breeze (Blade/Tailwind)
- **Auth & Role**: Laravel Auth + Spatie Permission
- **PDF**: Barryvdh DomPDF
- **Notifikasi**: SweetAlert2
- **Database**: MySQL

 Instalasi

```bash
# 1. Clone
git clone <repo-url>
cd siakad

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Edit .env - konfigurasi database
DB_CONNECTION=mysql
DB_DATABASE=siakad
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrasi & seeder
php artisan migrate --seed

# 6. Jalankan
npm run build
php artisan serve
```