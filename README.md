# Login admin
```
login admin melalui page login dokter

username    : admin
password    : admin
```

# Login dokter
```
password adalah username, jadi password dan username dimasukan nama dokter nya

username    : (nama dokter)
password    : (nama dokter)
```

# Database
```
database mySQL phpmyadmin,
database bernama "poliklinik", file database berada dalam folder db
```

# Cara Running
```
## Prasyarat

Sebelum menjalankan aplikasi, pastikan Anda telah menginstal perangkat berikut:

1. **XAMPP** (perangkat lunak server lokal lain yang mendukung PHP, MySQL, dan PHPMyAdmin)
2. Browser web

---

## Langkah-Langkah Pengaturan

### 1. Unduh proyek dari github

Unduh file atau proyek dari github ke komputer Anda.download ZIP BengkodBimkar

extract dan 

Letakkan folder proyek ke direktori `htdocs` (untuk XAMPP)

folder htdocs berada di dalam folder directori C

contoh =
 C:\xampp\htdocs


### 2. Jalankan Server Lokal

1. Buka aplikasi server lokal XAMPP.
2. Aktifkan modul **Apache** dan **MySQL**.

### 3. Atur Database

1. Buka browser dan akses PHPMyAdmin:

http://localhost/phpmyadmin

2. Buat database baru:
- Gunakan nama yang sesuai dengan konfigurasi dalam file aplikasi (nama database didalam file, `koneksi.php`).
- Contoh: `poliklinik`

3. Impor file database:
- Klik nama database yang baru dibuat.
- Buka tab **Import**.
- Pilih file SQL yang disertakan dalam proyek (`poliklinik.sql`).
- Klik **Go** untuk memulai proses impor.

### 4. Konfigurasi Koneksi Database

Buka file `koneksi.php` di vsCode, lalu sesuaikan pengaturan berikut JIKA DIPERLUKAN:

```php
$host = "localhost";        // Host database
$user = "root";             // Nama pengguna database (default: 'root' untuk XAMPP/WAMP)
$password = "";             // Kata sandi database (kosong untuk XAMPP/WAMP)
$dbname = "database_anda";  // Nama database yang Anda buat

## Jalankan Aplikasi

Buka Browser web

lalu run localhost dan folder yang dituju dengan mengakses urlberikut

semisalkan=

http://localhost/<nama-folder-proyek>

#### Ganti <nama-folder-proyek> dengan nama direktori proyek Anda.

contoh:

http://localhost/BengkodBimkar
