# Seni Bina Sistem (System Architecture) - Sistem Aduan UTeM

Dokumen ini menjelaskan teknologi, alat (tools), dan struktur teknikal yang digunakan untuk membina dan menyokong Sistem Aduan UTeM.

## 1. Teras Teknologi (Core Stack)
Sistem ini dibina menggunakan **TALL Stack**, sebuah ekosistem yang sangat popular dan stabil dalam komuniti Laravel.
*   **Backend & API:** Laravel (PHP)
*   **Pangkalan Data (Database):** MySQL
*   **Frontend (Antaramuka):** Laravel Livewire & Alpine.js
    *   *Alasan:* Livewire membolehkan pembinaan antaramuka yang dinamik dan interaktif (seperti SPA - Single Page Application) menggunakan PHP tanpa perlu menulis banyak JavaScript secara berasingan.
*   **Penggayaan (Styling):** Tailwind CSS

## 2. Pengurusan Log Masuk & Akses (Authentication & Authorization)
*   **Sistem Log Masuk:** Laravel Breeze (Versi Livewire)
    *   *Alasan:* Breeze adalah pakej auth yang ringan, pantas, dan mudah diubah suai mengikut keperluan khusus sistem Helpdesk.
*   **Peringkat Akses (Role-Based Access Control - RBAC):** Spatie Laravel Permission
    *   *Alasan:* Standard industri yang memudahkan penetapan peranan pengguna (Super Admin, Ketua Jabatan, Staf) dan kawalan fungsi dalam sistem.

## 3. Sistem Pelbagai Bahasa (Localization / Multi-language)
*   Sistem ini diwajibkan menyokong **Bahasa Inggeris (en)** dan **Bahasa Melayu (ms)**.
*   **Pendekatan:** Menggunakan ciri *Localization* terbina dalam Laravel. Semua teks pada UI tidak boleh "hardcoded" (ditulis terus). Ia mesti menggunakan fungsi bantuan (helper) penterjemahan seperti `__('Submit Ticket')`. Fail terjemahan disimpan di dalam folder `lang/`.

## 4. Keperluan Keselamatan (Security)
*   **Pencegahan Spam:** Google reCAPTCHA (v2 atau v3) akan diintegrasikan pada borang aduan awam (Guest Ticket).
*   **Pelindungan Asas:** Perlindungan CSRF, XSS, dan SQL Injection diuruskan secara automatik oleh kerangka kerja (framework) Laravel.

## 5. Pengujian (Testing Environment)
*   Ujian diwajibkan untuk setiap modul penting.
*   **Framework Ujian:** PHPUnit atau Pest (Berdasarkan ketetapan sedia ada Laravel).

## 6. Prinsip Reka Bentuk Tambahan
*   Gunakan queue untuk e-mel, notifikasi dan kerja berat supaya permintaan web kekal pantas.
*   Simpan lampiran pada private storage dan hidangkan melalui endpoint yang mengesahkan kebenaran pengguna.
*   Gunakan Laravel Policies/Gates bersama Spatie Permission untuk kawalan akses pada peringkat tindakan dan rekod.
*   Gunakan Events/Listeners untuk audit log dan notifikasi supaya logik domain tidak terikat pada controller.
*   Semua perubahan schema mesti dibuat melalui migration dan semua teks UI melalui localization.
*   CI mesti menjalankan format check, ujian, pemeriksaan keselamatan dependency dan frontend build.

## 7. Aliran Data Ringkas
1. Pelanggan menghantar borang dan sistem mengesahkan CAPTCHA, rate limit, input serta lampiran.
2. Sistem mencipta tiket, Tracking ID, audit log dan job notifikasi.
3. Staf melihat hanya tiket yang dibenarkan oleh jabatan dan permission mereka.
4. Perubahan status atau balasan direkodkan dalam thread, audit log dan sejarah status.
5. Queue menghantar notifikasi; scheduler memeriksa SLA dan melaksanakan eskalasi.

## 8. Keselamatan Operasi
*   Akaun `super_admin` dan pentadbir mesti menyokong two-factor authentication (2FA).
*   Sistem mesti menetapkan session timeout, login throttling dan security headers termasuk Content Security Policy.
*   Secret production mesti diurus melalui secret manager atau mekanisme yang setara dan dirotasi secara berkala.
*   Semua operasi penting hendaklah mempunyai request/correlation ID untuk memudahkan siasatan log.
