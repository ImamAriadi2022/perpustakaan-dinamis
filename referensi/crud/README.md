# pt_CRUD

Tentu, berikut adalah draft dokumentasi README.md yang bisa Anda gunakan, berdasarkan repositori GitHub yang Anda berikan:

**pt_CRUD: Aplikasi CRUD Sederhana dengan CodeIgniter 3**

Aplikasi pt_CRUD adalah proyek sederhana yang mendemonstrasikan konsep CRUD (Create, Read, Update, Delete) menggunakan framework CodeIgniter 3. Aplikasi ini dibuat untuk tujuan pembelajaran dan dapat dijadikan dasar untuk pengembangan aplikasi berbasis web yang lebih kompleks.

## Fitur Utama

- **Data Karyawan:** Kelola data karyawan (tambah, lihat, ubah, hapus) dengan mudah.
- **CodeIgniter 3:** Dibangun menggunakan framework CodeIgniter 3 yang populer dan stabil.
- **CRUD Dasar:** Implementasi dasar operasi CRUD untuk pengelolaan data.
- **Desain Sederhana:** Tampilan antarmuka yang sederhana dan mudah dipahami.

## Instalasi

1. **Klon Repositori:**
   ```bash
   git clone https://github.com/ImamAriadi2022/pt_CRUD.git
   ```

2. **Konfigurasi Database:**
   - Buka file `application/config/database.php`.
   - Sesuaikan pengaturan koneksi database (hostname, username, password, database) sesuai dengan lingkungan Anda.

3. **Jalankan Aplikasi:**
   - Pindahkan folder proyek ke direktori web server Anda (misalnya, `htdocs` untuk XAMPP).
   - Akses aplikasi melalui browser dengan URL sesuai konfigurasi web server Anda.

## Penggunaan

1. **Halaman Utama (Karyawan):**
   - Menampilkan daftar karyawan yang ada.
   - Tombol "Tambah" untuk menambahkan data karyawan baru.
   - Tombol "Edit" dan "Hapus" untuk mengelola data karyawan.

2. **Halaman Tambah/Edit Karyawan:**
   - Formulir untuk mengisi data karyawan (nama, alamat, email, telepon).
   - Tombol "Simpan" untuk menyimpan data karyawan.

## Struktur Folder

```
pt_CRUD/
├── application/
│   ├── config/        (Konfigurasi aplikasi)
│   ├── controllers/   (Kontroler aplikasi)
│   ├── models/        (Model aplikasi)
│   ├── views/         (Tampilan aplikasi)
│   └── ...
├── assets/           (File CSS, JavaScript, gambar, dll.)
├── system/           (Folder sistem CodeIgniter)
└── ...
```

## Kontribusi

Kontribusi sangat diharapkan! Jika Anda menemukan bug atau memiliki ide untuk perbaikan, silakan buat pull request.


## Penulis

Imam Ariadi 


**Catatan:**

* Pastikan Anda sudah menginstal CodeIgniter 3 dan web server (misalnya, XAMPP) sebelum menjalankan aplikasi ini.
* Sesuaikan konfigurasi database di file `application/config/database.php`.

Semoga dokumentasi ini bermanfaat! Jika ada pertanyaan lebih lanjut, jangan ragu untuk bertanya.