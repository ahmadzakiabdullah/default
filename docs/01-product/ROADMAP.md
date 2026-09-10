# Pelan Pembangunan (Roadmap) - Sistem Aduan UTeM

Dokumen ini merangka fasa-fasa pembangunan untuk Sistem Aduan UTeM. Pendekatan berperingkat (phased approach) ini membolehkan sistem dibina secara tangkas (agile) dan mudah diurus.

## Fasa 1: Teras Pelanggan (Guest Ticketing Core)
Fasa ini menumpukan kepada membolehkan orang awam/pelanggan menghantar dan menyemak aduan.
* [ ] Permulaan Projek (Laravel Install, Setup Database).
* [ ] Membina antar muka (UI) "Borang Hantar Aduan" berserta SPAM Prevention (Captcha).
* [ ] Membina logik menyimpan tiket ke dalam pangkalan data dan menjana `Tracking ID`.
* [ ] Membina antar muka "Semak Aduan" menggunakan `Tracking ID`.
* [ ] Membina halaman Lupa Tracking ID (Hantar ID ke e-mel pelanggan).
* [ ] Melindungi semakan tiket dengan pengesahan e-mel/token dan rate limiting.
* [ ] Menyokong lampiran private dengan validasi jenis, saiz dan keselamatan fail.

## Fasa 2: Papan Pemuka Pentadbir (Admin Dashboard & Auth)
Fasa ini tertumpu kepada pihak pengurusan dan kakitangan.
* [ ] Memasang sistem Log Masuk (Laravel Breeze / UI).
* [ ] Menetapkan Sistem Peringkat Akses (Role-Based Access Control) menggunakan Spatie.
* [ ] Membina Papan Pemuka (Dashboard) memaparkan ringkasan tiket.
* [ ] Membina halaman Pengurusan Tiket (Senarai tiket, penapis mengikut jabatan, status).
* [ ] Membina fungsi untuk Kakitangan membalas tiket (Thread).
* [ ] Menyediakan matriks permission dan pengasingan data mengikut jabatan.
* [ ] Menyediakan carian, penapisan, pagination dan tindakan pukal.

## Fasa 3: Ciri-Ciri Lanjutan (Advanced Features)
Fasa untuk melonjakkan kemampuan sistem ke tahap gred-perusahaan (enterprise).
* [ ] Integrasi Notifikasi E-mel (Hantar e-mel apabila ada tiket baharu / balasan).
* [ ] Membangunkan sistem log rekod Jejak Audit (Audit Trail).
* [ ] Modul Laporan & Analitik (Eksport senarai ke Excel/PDF).
* [ ] Membina sistem pemantauan SLA (Mewarnakan tiket merah jika melebihi tempoh).
* [ ] Menambah sejarah status, eskalasi SLA dan kalendar waktu bekerja/cuti umum.
* [ ] Menambah penilaian kepuasan pelanggan selepas tiket ditutup.

## Fasa 4: Kemasan Akhir (Polishing & Deployment)
Langkah persediaan sebelum sistem dilancarkan kepada pengguna.
* [ ] Membina Modul Knowledge Base / Soalan Lazim (FAQ).
* [ ] Pengujian Sistem (Unit Testing / Feature Testing).
* [ ] Kemasan Antaramuka (Responsif / Mobile Friendly).
* [ ] Pelancaran (Deployment) ke pelayan (server) pengeluaran UTeM.
* [ ] Menyediakan CI/CD, health checks, monitoring, backup-restore dan disaster recovery.
* [ ] Menyediakan dokumentasi API, ERD dan panduan sumbangan.
