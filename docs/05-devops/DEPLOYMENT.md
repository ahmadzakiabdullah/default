# Garis Panduan Pelancaran (Deployment Guide) - Sistem Aduan UTeM

Dokumen ini menyenaraikan keperluan infrastruktur pelayan (server) dan langkah-langkah ringkas untuk melancarkan (deploy) sistem ini ke persekitaran pengeluaran (Production) di UTeM.

## 1. Keperluan Infrastruktur (Server Requirements)
Oleh kerana sistem ini menggunakan kerangka kerja Laravel terkini, pelayan mesti menyokong:
*   **Sistem Operasi:** Linux (Ubuntu 22.04 LTS / 24.04 LTS digalakkan).
*   **Web Server:** Nginx atau Apache (dengan mod_rewrite diaktifkan).
*   **PHP:** Versi 8.2 atau lebih tinggi (berserta extension penting: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, cURL).
*   **Pangkalan Data:** MySQL 8.0+ atau MariaDB 10.4+.
*   **Node.js:** Versi 18+ (Hanya diperlukan semasa proses binaan (build) untuk Tailwind CSS dan Vite).
*   **Pengurusan Pakej:** Composer v2.

## 2. Langkah-langkah Pelancaran (Deployment Steps)
Untuk pelancaran secara manual atau melalui saluran CI/CD, langkah asas berikut mesti dipatuhi di pelayan pengeluaran:

1.  **Dapatkan Kod Sumber (Clone Repository)**
    ```bash
    git clone [URL-REPOSITORI]
    cd [NAMA-FOLDER]
    ```

2.  **Pasang Pakej (Install Dependencies)**
    ```bash
    composer install --optimize-autoloader --no-dev
    npm install
    npm run build
    ```

3.  **Tetapan Persekitaran (Environment Configuration)**
    *   Salin fail `.env.example` kepada `.env`.
    *   Kemaskini konfigurasi pangkalan data (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    *   Tetapkan konfigurasi emel SMTP (`MAIL_MAILER`, dll).
    *   Jana kunci aplikasi: `php artisan key:generate`.

4.  **Pangkalan Data & Fail Statik**
    ```bash
    # Bina jadual pangkalan data (Amaran: Jangan guna --seed di production jika data sudah wujud)
    php artisan migrate --force

    # Pautkan folder storan lampiran (untuk muat naik fail/gambar)
    php artisan storage:link
    ```

5.  **Pengoptimuman (Optimization for Production)**
    Laksanakan arahan ini supaya aplikasi berjalan lebih pantas:
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    ```

6.  **Pengurusan Background Jobs (Pilihan tapi disyorkan)**
    Jika fungsi e-mel menggunakan *queue*, pastikan *Supervisor* dikonfigurasi untuk menjalankan arahan:
    `php artisan queue:work` secara berterusan di latar belakang.

## 3. Sandaran (Backup)
*   Sistem pangkalan data dan folder `storage/app/public/` (lampiran tiket) wajib disandarkan (backup) secara harian oleh pasukan IT UTeM.

## 4. Keselamatan dan Operasi Pengeluaran
*   Gunakan HTTPS, secret manager atau permission fail yang sesuai; jangan commit `.env`.
*   Tetapkan Supervisor untuk `queue:work` dan scheduler untuk tugas SLA/notifikasi.
*   Sediakan endpoint health check, pemantauan error, penggunaan disk, queue dan masa respons.
*   Backup mesti diuji melalui proses restore berkala; sasarkan RPO/RTO yang dipersetujui bersama UTeM.
*   Untuk release, gunakan maintenance strategy yang selamat, jalankan migration dahulu dan sediakan rollback plan.

## 5. CI/CD Minimum
Pipeline mesti menjalankan `composer install`, pemeriksaan kod, `php artisan test`, `npm run build`, audit dependency dan deployment ke staging sebelum production.

## 6. Monitoring dan Alert
*   Pantau uptime, error rate, response time, queue failure, penggunaan disk dan database.
*   Hantar alert kepada pasukan IT apabila queue gagal, SLA dilanggar, backup gagal atau disk hampir penuh.
*   Sediakan health check yang tidak mendedahkan secret atau maklumat dalaman.
