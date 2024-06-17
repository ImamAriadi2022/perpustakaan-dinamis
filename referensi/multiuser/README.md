
## Dokumentasi Proyek pt_loginSederhana (dengan Multi-Role)

### Deskripsi Proyek

Proyek ini, `pt_loginSederhana`, adalah sebuah aplikasi login sederhana yang telah saya bangun menggunakan PHP, MySQL, (potensial) JavaScript, dan CSS. Aplikasi ini memungkinkan pengguna untuk:

1.  **Mendaftar:** Membuat akun baru dengan peran (role) sebagai admin atau user.
2.  **Masuk (Login):** Mengakses akun dengan nama pengguna dan kata sandi yang benar.
3.  **Dashboard:** Melihat halaman "dashboard" yang berbeda sesuai dengan peran pengguna.
4.  **Keluar (Logout):** Mengakhiri sesi login.

### Fitur Utama

1.  **Pendaftaran Pengguna (register.php):**
    *   Mengumpulkan input nama pengguna, email, kata sandi, dan peran (admin/user).
    *   Memvalidasi input (sebaiknya di sisi server dan klien).
    *   Menghash kata sandi sebelum menyimpannya ke database untuk keamanan.
    *   Menyimpan data pengguna baru, termasuk peran, ke database MySQL.

2.  **Login Pengguna (index.php):**
    *   Mengumpulkan input nama pengguna dan kata sandi.
    *   Memvalidasi input.
    *   Membandingkan kata sandi yang dimasukkan dengan hash yang tersimpan di database.
    *   Jika cocok, memeriksa peran pengguna dan memulai sesi login.
    *   Mengarahkan pengguna ke halaman dashboard yang sesuai dengan peran mereka (admin atau user).

3.  **Halaman Dashboard (dashboard.php & admin.php):**
    *   **dashboard.php:** Halaman dashboard untuk pengguna biasa (user).
    *   **admin.php:** Halaman dashboard khusus untuk admin, mungkin dengan fitur tambahan seperti manajemen pengguna.
    *   Kedua halaman ini memeriksa apakah pengguna sudah login dan memiliki peran yang sesuai sebelum menampilkan konten.

4.  **Logout (logout.php):**
    *   Menghancurkan sesi login.
    *   Mengarahkan pengguna kembali ke halaman login.

### Struktur File dan Folder

*   `index.php`: Halaman utama (formulir login).
*   `register.php`: Halaman pendaftaran.
*   `dashboard.php`: Halaman dashboard untuk user.
*   `admin.php`: Halaman dashboard untuk admin.
*   `koneksi.php`: Konfigurasi koneksi database MySQL.
*   `style.css`: Gaya CSS untuk tampilan aplikasi.
*   `(Opsional) script.js`: Kode JavaScript untuk validasi input, efek visual, atau AJAX.

### Implementasi Multi-Role

*   **Database:** Saya menambahkan kolom `role` (misalnya ENUM('admin', 'user')) pada tabel pengguna di database.
*   **Pendaftaran:** Saat pengguna mendaftar, peran yang mereka pilih akan disimpan ke dalam kolom `role`.
*   **Login:** Setelah berhasil login, peran pengguna disimpan ke dalam variabel sesi (misalnya `$_SESSION['role']`).
*   **Dashboard:** Pernyataan kondisional (misalnya `if ($_SESSION['role'] == 'admin')`) digunakan untuk menampilkan halaman dashboard yang sesuai dengan peran pengguna.

### Contoh Kode (PHP)

```php
// index.php (cuplikan)
if ($user && password_verify($password, $user["password"])) {
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $user["role"]; // Simpan peran ke dalam sesi

    if ($_SESSION["role"] == "admin") {
        header("location: admin.php");
    } else {
        header("location: dashboard.php");
    }
    exit;
}
```

### Rekomendasi Peningkatan

*   **Manajemen Pengguna (untuk Admin):**
    *   Menambahkan fitur untuk admin agar dapat melihat, mengedit, atau menghapus pengguna lain.
*   **Otorisasi:**
    *   Implementasikan mekanisme otorisasi untuk membatasi akses ke fitur atau halaman tertentu berdasarkan peran pengguna.

### Kesimpulan

Proyek `pt_loginSederhana` ini adalah dasar yang baik untuk aplikasi login. Dengan peningkatan yang disarankan, aplikasi ini dapat menjadi lebih aman, fungsional, dan mudah digunakan.
