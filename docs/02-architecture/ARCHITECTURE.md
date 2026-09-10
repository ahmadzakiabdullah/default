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
