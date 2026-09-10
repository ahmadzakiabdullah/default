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
*   **[Tambahan] Knowledge Base / FAQ:** Paparan artikel bantuan atau Soalan Lazim sebelum borang dihantar untuk mengurangkan pertanyaan berulang.

## 4. Pengurusan Tiket (Admin & Staff Dashboard)
*   **Log Masuk Ejen:** Kakitangan (Staff/Admin) mesti log masuk untuk membalas aduan (Boleh diintegrasi dengan sistem Single Sign-On UTeM atau login berasingan).
*   **Senarai Tugas:** Dashboard menyenaraikan aduan mengikut kategori/jabatan kakitangan tersebut.
*   **Status Aduan:** Aduan boleh ditetapkan status (Cth: Terbuka, Dalam Tindakan, Selesai, Ditutup).
*   **Pematuhan SLA (Service Level Agreement):** Sistem boleh merekod/memantau sasaran balasan: "Pertanyaan: 3 hari bekerja", "Aduan: 14 hari bekerja".

## 5. Peningkatan Pengurusan Lanjutan (Advanced Management Capabilities)
*   **[Tambahan] Sistem Notifikasi E-mel:** Penghantaran e-mel automatik apabila tiket dihantar (berserta Tracking ID), status diubah, atau apabila komen baharu ditambah.
*   **[Tambahan] Pelaporan & Statistik (Analytics):** Dashboard pintar untuk penjanaan laporan (Eksport ke Excel/PDF). Pemantauan prestasi jabatan, kelajuan membalas tiket, dan pematuhan SLA.
*   **[Tambahan] Jejak Audit (Audit Trail):** Rakaman log bagi setiap tindakan (cth: siapa yang menukar status tiket, tarikh/masa ditukar) untuk ketelusan dan siasatan masa depan.
*   **[Tambahan] Peringkat Akses (Role-Based Access Control - RBAC):** Pembahagian kuasa yang jelas antara Super Admin, Ketua Jabatan, dan Staf Sokongan.

## 6. Peningkatan Moden (Modern Upgrades)
*   **Responsif (Mobile-Friendly):** Antaramuka wajib berfungsi dengan cantik dan mudah pada peranti pintar / telefon bimbit.
*   **Keselamatan Terkini:** Perlindungan moden Laravel (CSRF, XSS).
*   **Pilihan Dwi-Bahasa:** Menyokong Bahasa Melayu dan Bahasa Inggeris (seperti pilihan "Go" pada sistem asal).

## 7. Keperluan Keselamatan dan Operasi Tambahan
*   Penghantaran tiket, semakan tiket dan permintaan Tracking ID mesti dilindungi dengan rate limiting.
*   Pelanggan mesti mengesahkan e-mel atau menggunakan token akses yang selamat sebelum melihat atau membalas tiket.
*   Lampiran mesti mempunyai had saiz dan jenis fail, disimpan secara private, serta disemak daripada fail berbahaya.
*   Sistem mesti merekod masa respons pertama, tarikh tamat SLA dan sejarah perubahan status.
*   SLA mesti menyokong waktu bekerja, cuti umum dan konfigurasi berbeza mengikut kategori atau keutamaan.
*   Sistem mesti menyokong carian, penapisan, pagination dan tindakan pukal untuk pengurusan tiket.
*   Selepas tiket ditutup, pelanggan boleh memberikan penilaian kepuasan ringkas.

## 8. Keperluan Aksesibiliti dan Kualiti
*   Antaramuka mesti boleh digunakan melalui keyboard, mempunyai label borang yang jelas dan mematuhi kontras warna yang baik.
*   Semua fungsi utama mesti mempunyai ujian automatik dan dijalankan melalui CI.
*   Sistem mesti menyediakan prosedur backup, pemulihan dan pemantauan kegagalan queue.

## 9. Privasi dan Tadbir Urus Data
*   Borang mesti memaparkan notis privasi dan tujuan pengumpulan data.
*   Akses kepada data pelanggan mesti dihadkan mengikut peranan dan jabatan.
*   Sistem mesti menyokong retention policy, anonymization dan pemadaman data tertakluk kepada keperluan rekod rasmi.
*   Audit log mesti mempunyai tempoh retention dan akses yang terhad.
*   Pengendalian data mesti mematuhi keperluan PDPA Malaysia dan polisi UTeM yang berkuat kuasa.
