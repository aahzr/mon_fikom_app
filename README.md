# SiMonik - Sistem Informasi Monitoring Dosen

Sistem Informasi Monitoring Kinerja (SiMonik) Dosen adalah sebuah aplikasi web yang dibangun menggunakan framework Laravel. Aplikasi ini bertujuan untuk membantu dosen dalam mengelola dan memonitor data-data penting terkait kinerja akademis, penelitian, pengabdian, hingga administrasi.

## Tentang Proyek

SiMonik dirancang dengan antarmuka yang bersih dan minimalis, memungkinkan dosen untuk dengan mudah menginput dan memantau berbagai data, termasuk:
-   **Profil Dosen:** Data pribadi, jabatan fungsional, kepangkatan, dan penempatan.
-   **Aktivitas Penelitian & Pengabdian:** Mengelola proposal, laporan, dan luaran dari setiap kegiatan.
-   **Manajemen Keuangan:** Memantau data-data keuangan yang relevan.

Aplikasi ini menggunakan pendekatan Single Page Application (SPA) parsial dengan teknologi AJAX untuk memberikan pengalaman pengguna yang lebih cepat dan interaktif saat menavigasi menu profil.

## Fitur Utama

-   **Dashboard Beranda:** Ringkasan cepat mengenai status profil, jumlah proposal, laporan, dan data keuangan.
-   **Manajemen Profil:** Memungkinkan dosen untuk memperbarui dan menyimpan data pribadi secara terperinci.
-   **Pengelolaan Dokumen:** Unggah dan kelola dokumen penting seperti proposal, laporan, dan luaran.
-   **Sinkronisasi Data:** Nama dan foto profil diperbarui secara otomatis di seluruh halaman setelah data disimpan.
-   **Otentikasi Aman:** Sistem login yang terintegrasi dengan peran pengguna (Dosen).

## Teknologi yang Digunakan

-   **Backend:** Laravel Framework (PHP)
-   **Database:** SQLite (atau database relasional lain)
-   **Frontend:** Tailwind CSS (via CDN), jQuery, SweetAlert2
-   **Environment:** PHP 8.x

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1.  Clone repositori ini:
    ```bash
    git clone [URL_REPOSITORI_ANDA]
    ```

2.  Masuk ke direktori proyek:
    ```bash
    cd nama-proyek-anda
    ```

3.  Instal dependensi Composer:
    ```bash
    composer install
    ```

4.  Salin file `.env.example` dan buat file `.env`:
    ```bash
    cp .env.example .env
    ```

5.  Buat *application key*:
    ```bash
    php artisan key:generate
    ```

6.  Jalankan migrasi database dan seed data (jika ada):
    ```bash
    php artisan migrate --seed
    ```

7.  Buat symbolic link untuk penyimpanan publik (jika belum ada):
    ```bash
    php artisan storage:link
    ```

8.  Jalankan server pengembangan Laravel:
    ```bash
    php artisan serve
    ```

Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

## Penggunaan

-   Masuk (login) menggunakan akun yang sudah terdaftar.
-   Halaman **Beranda** akan menampilkan ringkasan aktivitas.
-   Gunakan menu **Profil** di sidebar untuk memperbarui data pribadi dan informasi lainnya.
-   Tampilan header dan sidebar akan otomatis diperbarui setelah Anda menyimpan perubahan profil.

## Kontribusi

Kami menyambut baik kontribusi dari siapa saja. Jika Anda menemukan bug, memiliki ide fitur baru, atau ingin membantu memperbaiki kode, silakan ajukan *pull request* atau buka *issue* di repositori ini.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).