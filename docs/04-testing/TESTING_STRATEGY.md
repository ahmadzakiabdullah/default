# Strategi Ujian (Testing Strategy) - Sistem Aduan UTeM

Dokumen ini menetapkan garis panduan dan pendekatan pengujian automatik untuk memastikan kualiti dan kestabilan Sistem Aduan UTeM. Sistem ini mewajibkan pengujian berterusan (Test-Driven Development atau Test-First approach).

## 1. Alat Pengujian (Testing Tools)
*   **Kerangka Ujian:** PHPUnit atau Pest (Pest adalah sangat digalakkan untuk sintaks yang lebih ringkas).
*   **Mocking:** Mockery (terbina dalam Laravel) untuk simulasi penghantaran e-mel dan sistem pihak ketiga.
*   **Pengujian Pangkalan Data:** Menggunakan trait `RefreshDatabase` untuk memastikan pangkalan data ujian sentiasa dalam keadaan bersih sebelum dan selepas ujian dijalankan.

## 2. Skop Pengujian
Pengujian dibahagikan kepada dua kategori utama:

### 2.1. Ujian Unit (Unit Testing)
Menguji fungsi logik kecil secara berasingan tanpa menyentuh pangkalan data atau rangkaian.
*   **Contoh:**
    *   Fungsi untuk menjana `Tracking ID` (memastikan ID unik dan menepati format).
    *   Pengiraan waktu SLA (Sistem mesti menolak hujung minggu dan cuti umum jika SLA ditetapkan pada "3 hari bekerja").

### 2.2. Ujian Ciri (Feature Testing)
Menguji keseluruhan aliran aplikasi, dari permintaan HTTP (HTTP Request) sehingga pangkalan data dikemaskini.
*   **Modul Borang Awam (Guest Ticket):**
    *   Borang berjaya dihantar apabila data lengkap.
    *   Borang ditolak (Validation Error) jika e-mel salah format atau captcha gagal.
*   **Modul Akses (Auth & RBAC):**
    *   Hanya pengguna yang mempunyai peranan `admin_jabatan` boleh menukar status tiket.
    *   Staf dari Jabatan A tidak boleh melihat atau membalas tiket milik Jabatan B.
*   **Modul Notifikasi:**
    *   Sistem berjaya meletakkan e-mel ke dalam *queue* (atur gilir) apabila aduan baharu direkodkan.

## 3. Pelaksanaan Pengujian (Execution)
Semua pembangun (termasuk ejen AI) **diwajibkan** untuk:
1. Menulis fail ujian di dalam folder `tests/Feature` atau `tests/Unit`.
2. Menjalankan arahan `php artisan test` secara lokal.
3. Memastikan **100% kelulusan (passing tests)** sebelum melakukan penyerahan kod (commit / pull request).

## 4. Penunjuk Prestasi Ujian (Metrics)
*   Sasaran *Code Coverage* minimum adalah 80% bagi kod logik perniagaan (Business Logic).
