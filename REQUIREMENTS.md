# Keperluan Sistem (System Requirements) - Sistem Aduan UTeM

Dokumen ini menyenaraikan ciri-ciri dan fungsi utama yang dirancang untuk menaik taraf **Sistem Aduan Dan Maklumbalas Pelanggan UTeM** (menggantikan sistem lama di `help.utem.edu.my`).

## 1. Aliran Utama (Flow of the System)
Sistem ini menggunakan aliran **"Guest Ticketing"**, yang membolehkan warga UTeM dan orang awam menghantar aduan tanpa perlu mempunyai akaun log masuk, tetapi mengekalkan keselamatan melalui **Tracking ID**.
*   **Hantar Aduan (Submit Ticket):** Borang am untuk semua pelanggan menghantar masalah/aduan.
*   **Semak Aduan (View Ticket):** Pelanggan menyemak status balasan menggunakan gabungan **Tracking ID** (ID Jejak) dan/atau E-mel.
*   **Lupa Tracking ID:** Pelanggan boleh meminta Tracking ID dihantar ke e-mel mereka.

## 2. Borang Hantar Aduan (Submit a Ticket)
Borang utama wajib (dan pilihan) mempunyai medan-medan berikut:
*   **Maklumat Pemohon:**
    *   Nama (Wajib)
    *   E-mel (Wajib)
    *   Nombor Telefon (Wajib)
    *   Alamat (Pilihan)
*   **Maklumat Aduan:**
    *   Kategori / Jabatan (Wajib - *Drop down menu*)
    *   Keutamaan / Priority (Wajib - *Drop down menu*)
    *   Subjek / Tajuk (Wajib)
    *   Mesej / Butiran (Wajib)
    *   Lampiran / Attachments (Pilihan - Boleh muat naik fail/gambar tertakluk pada had fail)
*   **Keselamatan:**
    *   SPAM Prevention (Captcha keselamatan bergambar / Google reCAPTCHA)

## 3. Sistem Paparan Pelanggan (View Ticket)
*   Pelanggan memasukkan **Tracking ID** untuk membaca kemas kini dan membalas aduan.
*   Pelanggan boleh melihat Sejarah Balasan (Thread) daripada pihak admin/kakitangan mengikut tarikh.

## 4. Pengurusan Tiket (Admin & Staff Dashboard)
*   **Log Masuk Ejen:** Kakitangan (Staff/Admin) mesti log masuk untuk membalas aduan (Boleh diintegrasi dengan sistem Single Sign-On UTeM atau login berasingan).
*   **Senarai Tugas:** Dashboard menyenaraikan aduan mengikut kategori/jabatan kakitangan tersebut.
*   **Status Aduan:** Aduan boleh ditetapkan status (Cth: Terbuka, Dalam Tindakan, Selesai, Ditutup).
*   **Pematuhan SLA (Service Level Agreement):** Sistem boleh merekod/memantau sasaran balasan: "Pertanyaan: 3 hari bekerja", "Aduan: 14 hari bekerja".

## 5. Peningkatan Moden (Modern Upgrades)
*   **Responsif (Mobile-Friendly):** Antaramuka wajib berfungsi dengan cantik dan mudah pada peranti pintar / telefon bimbit.
*   **Keselamatan Terkini:** Perlindungan moden Laravel (CSRF, XSS).
*   **Pilihan Dwi-Bahasa:** Menyokong Bahasa Melayu dan Bahasa Inggeris (seperti pilihan "Go" pada sistem asal).
