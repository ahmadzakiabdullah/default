# Keperluan Sistem (System Requirements) - Sistem Helpdesk

Dokumen ini menyenaraikan ciri-ciri dan fungsi utama yang dirancang untuk Sistem Helpdesk Organisasi.

## 1. Peranan Pengguna (User Roles)
Sistem ini secara asasnya akan mempunyai sekurang-kurangnya dua peranan:
*   **Pengguna Biasa / Kakitangan (User):** Boleh mencipta tiket aduan, melihat status tiket mereka sendiri, dan membalas komen pada tiket tersebut.
*   **Admin / Ejen Sokongan (Admin/Agent):** Boleh melihat semua tiket, menukar status tiket, membalas tiket pengguna, dan menguruskan sistem.

## 2. Pengurusan Tiket (Ticket Management)
*   **Penciptaan Tiket:** Borang aduan yang memerlukan tajuk, deskripsi, dan kategori aduan (cth: IT, Fasiliti, HR). Boleh memuat naik lampiran/gambar (pilihan).
*   **Status Tiket:** Setiap tiket mesti mempunyai status yang jelas. Contoh: `Baru` (New), `Sedang Diproses` (In Progress), `Selesai` (Resolved), `Ditutup` (Closed).
*   **Keutamaan (Priority):** Tiket boleh ditandakan dengan tahap keutamaan (cth: Rendah, Sederhana, Tinggi, Kritikal).
*   **Komen / Balasan:** Ruang perbincangan di dalam setiap tiket antara Pengguna dan Admin.

## 3. Papan Pemuka (Dashboard)
*   **Dashboard Pengguna:** Paparan ringkas jumlah tiket mereka mengikut status (cth: Berapa tiket yang sedang aktif, berapa yang selesai).
*   **Dashboard Admin:** Paparan statistik keseluruhan (jumlah tiket tertunggak, tiket yang memerlukan perhatian segera).

## 4. Sistem Log Masuk & Keselamatan (Authentication)
*   Pendaftaran (Registration) dan Log Masuk (Login) yang selamat.
*   Pemulihan kata laluan (Password Reset).

## 5. Notifikasi (Cadangan Masa Hadapan)
*   Notifikasi e-mel automatik apabila tiket baharu dicipta, atau apabila terdapat kemas kini status/komen baharu.

---
*Nota: Keperluan ini adalah sebagai panduan awal dan boleh dikemaskini mengikut kehendak organisasi dari semasa ke semasa.*
