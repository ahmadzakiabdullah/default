# Panduan UI/UX (Design System) - Sistem Aduan UTeM

Dokumen ini menggariskan piawaian reka bentuk antaramuka (UI) dan pengalaman pengguna (UX) untuk Sistem Aduan UTeM. Tujuannya adalah untuk memastikan ketekalan (consistency) rupa dan rasa di seluruh aplikasi.

## 1. Identiti Korporat (Corporate Identity)
Skema warna sistem mesti mematuhi atau diinspirasikan daripada warna rasmi UTeM. Kod warna ini perlu disetkan di dalam `tailwind.config.js`.

*   **Warna Utama (Primary):** Biru Gelap UTeM (Contoh: `#1D4ED8` / Tailwind `blue-700`). Digunakan untuk penjenamaan utama, butang tindakan utama (Call to Action), dan tajuk.
*   **Warna Aksen (Secondary/Accent):** Merah atau Kuning (sebagai highlight atau amaran).
*   **Warna Latar Belakang (Background):** Cerah dan bersih (Contoh: `#F3F4F6` / Tailwind `gray-100`) untuk halaman awam, dan putih penuh `#FFFFFF` untuk kawasan papan pemuka (Dashboard).
*   **Warna Teks (Text):** Kelabu gelap `#1F2937` untuk kebolehbacaan (readability) yang tinggi. Elakkan hitam pekat `#000000`.

## 2. Tipografi (Typography)
*   **Font Utama:** Gunakan font *Sans-serif* yang moden, bersih, dan mudah dibaca di skrin komputer serta peranti mudah alih (Mobile).
*   **Cadangan Font:** `Inter`, `Roboto`, atau `Figtree` (Font rasmi default Laravel).
*   **Hierarki Saiz:** Gunakan skala teks Tailwind (`text-sm`, `text-base`, `text-lg`, `text-2xl`) secara konsisten.

## 3. Komponen Antaramuka (UI Components)
*   **Bentuk (Shapes):** Gunakan bucu membulat yang lembut (`rounded-md` atau `rounded-lg`) pada butang, kotak input, dan kad (cards) untuk kelihatan mesra pengguna. Elakkan bucu terlalu tajam (sharp).
*   **Bayang-bayang (Shadows):** Gunakan bayang-bayang nipis (`shadow-sm` atau `shadow-md`) untuk menimbulkan efek "timbul" (depth) pada butang dan kad maklumat, memisahkan ia dari latar belakang.
*   **Mod Gelap (Dark Mode):** (Pilihan) Sistem sekurang-kurangnya bersedia untuk Mod Gelap, tetapi Mod Terang (Light Mode) adalah lalai (default).

## 4. Aliran Pengalaman Pengguna (UX Flow)
### 4.1. Borang Awam (Guest Ticket)
*   **Susun Atur (Layout):** Borang mestilah berpusat (centered) dan mempunyai saiz lebar maksimum (`max-w-2xl`) supaya tidak nampak terlalu panjang pada skrin komputer.
*   **Ringkas:** Gunakan medan (input fields) secara sebaris (grid) untuk nama/telefon jika skrin besar, tetapi susun ke bawah secara automatik (responsive) untuk skrin telefon pintar.
*   **Penunjuk (Indicators):** Medan wajib (Required) mesti ditanda jelas dengan asterisk merah `*`. Apabila ada ralat, mesej ralat (Validation error) mesti dipaparkan di bawah setiap kotak dengan warna merah yang jelas.

### 4.2. Papan Pemuka Pentadbir (Admin Dashboard)
*   **Navigasi (Navigation):** Gunakan reka bentuk Navigasi Sisi (Sidebar Navigation) yang boleh disembunyikan (collapsible) untuk memberi ruang kepada senarai tiket, serta Navigasi Atas (Top Navbar) untuk carian dan profil.
*   **Status Warna (Status Badges):**
    *   `Baru` / `Terbuka`: Biru / Cyan
    *   `Dalam Tindakan`: Kuning / Oren (menandakan kerja sedang jalan)
    *   `Selesai`: Hijau
    *   `Ditutup`: Kelabu
    *   `Melebihi SLA`: Merah terang (Kritikal)
*   **Jadual Data (Data Tables):** Jadual senarai tiket mesti menyokong penomboran halaman (pagination), kotak carian, dan mudah untuk skrol mendatar (horizontal scroll) pada skrin kecil.

## 5. Kebolehcapaian (Accessibility - a11y)
*   Mematuhi syarat "Kontras Warna yang Baik" (High contrast) antara teks dan latar belakang.
*   Menyokong navigasi menggunakan papan kekunci (Keyboard navigation / Tab index) pada borang.
*   Semua butang mesti ada efek `hover` dan `focus` untuk membantu pengguna tahu elemen mana yang sedang ditekan.
