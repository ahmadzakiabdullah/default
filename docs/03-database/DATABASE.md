# Reka Bentuk Pangkalan Data (Database Schema)

Dokumen ini menggariskan struktur asas jadual (tables) pangkalan data untuk Sistem Aduan UTeM. Struktur ini direka agar sesuai dengan *Eloquent ORM* di dalam Laravel.

## 1. Jadual: `users`
Digunakan untuk menyimpan maklumat kakitangan (Admin / Staf) yang boleh log masuk ke dalam sistem. Pelanggan (Guest) tidak disimpan di sini.

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik |
| `name` | String | Nama penuh kakitangan |
| `email` | String | E-mel rasmi (Unik) |
| `password` | String | Kata laluan (Hashed) |
| `role` | - | Peranan diuruskan oleh Spatie Laravel Permission, bukan lajur enum |
| `department_id` | FK, BigInt | Merujuk kepada jabatan kakitangan (Boleh Null) |
| `timestamps` | Datetime | `created_at` & `updated_at` |

## 2. Jadual: `departments` (Kategori/Jabatan)
Senarai jabatan yang boleh dipilih oleh pelanggan semasa membuat aduan.

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik |
| `name` | String | Nama Jabatan (Cth: Pusat Komputer, Hal Ehwal Pelajar) |
| `is_active` | Boolean | Status aktif jabatan (1 = Aktif, 0 = Tidak) |
| `timestamps` | Datetime | `created_at` & `updated_at` |

## 3. Jadual: `tickets` (Aduan Utama)
Menyimpan semua rekod aduan yang dihantar.

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik (Primary Key) |
| `tracking_id` | String | ID Jejak unik janaan sistem (Cth: TKT-2023-XYZ) - *Unik* |
| `guest_name` | String | Nama Pelanggan |
| `guest_email` | String | E-mel Pelanggan |
| `guest_phone` | String | No. Telefon Pelanggan |
| `guest_address`| Text | Alamat Pelanggan (Pilihan) |
| `department_id`| FK, BigInt | Merujuk kepada `departments.id` |
| `priority` | Enum | `rendah`, `sederhana`, `tinggi`, `kritikal` |
| `subject` | String | Tajuk Aduan |
| `message` | Text | Butiran Aduan |
| `status` | Enum | `baru`, `terbuka`, `dalam_tindakan`, `selesai`, `ditutup` |
| `assigned_to_user_id` | FK, BigInt | Merujuk kepada `users.id` (Staf yang ditugaskan) |
| `resolved_at` | Datetime | Tarikh & Masa aduan selesai (Untuk kiraan SLA) |
| `first_responded_at` | Datetime | Masa respons pertama staf |
| `due_at` | Datetime | Tarikh akhir SLA yang dikira berdasarkan waktu bekerja |
| `closed_at` | Datetime | Tarikh tiket ditutup |
| `timestamps` | Datetime | `created_at` (Tarikh Mula) & `updated_at` |

## 4. Jadual: `ticket_replies` (Balasan / Thread)
Menyimpan perbualan (balasan) antara pelanggan dan staf bagi setiap tiket.

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik |
| `ticket_id` | FK, BigInt | Merujuk kepada `tickets.id` |
| `user_id` | FK, BigInt | Boleh Null. Jika ada, bermakna balasan dari Staf. Jika Null, balasan dari Pelanggan. |
| `reply_text` | Text | Kandungan mesej balasan |
| `timestamps` | Datetime | `created_at` (Waktu dihantar) & `updated_at` |

## 5. Jadual: `ticket_attachments` (Lampiran)
Menyimpan rujukan fail/gambar yang dimuat naik (Satu aduan boleh ada banyak lampiran).

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik |
| `ticket_id` | FK, BigInt | Merujuk kepada `tickets.id` |
| `reply_id` | FK, BigInt | (Pilihan) Merujuk kepada `ticket_replies.id` jika lampiran dihantar dalam balasan |
| `file_name` | String | Nama asal fail (Cth: resit.jpg) |
| `file_path` | String | Lokasi fail di dalam server / storage |
| `timestamps` | Datetime | `created_at` & `updated_at` |

## 6. Jadual: `audit_logs` (Jejak Audit)
Untuk merekod setiap tindakan penting di dalam sistem.

| Nama Lajur (Column) | Jenis Data (Type) | Keterangan |
| :--- | :--- | :--- |
| `id` | PK, BigInt | ID Unik |
| `user_id` | FK, BigInt | ID staf yang melakukan tindakan (Boleh Null jika tindakan sistem/guest) |
| `action` | String | Jenis tindakan (Cth: Tukar Status, Padam Tiket) |
| `description` | Text | Butiran tindakan (Cth: Status ditukar dari Baru kepada Selesai) |
| `timestamps` | Datetime | Waktu kejadian direkod |

## 7. Jadual Sokongan Tambahan
*   `ticket_status_histories`: `ticket_id`, `from_status`, `to_status`, `changed_by`, `reason`, `created_at`.
*   `ticket_categories`: `name`, `is_active`, `default_sla_days` dan hubungan kepada jabatan jika diperlukan.
*   `sla_calendars` / `public_holidays`: konfigurasi waktu bekerja dan cuti umum.
*   `ticket_satisfactions`: `ticket_id`, `rating`, `comment`, `created_at`.

## 8. Integriti dan Keselamatan Data
*   `tracking_id` mesti mempunyai unique index; e-mel pengguna mesti mempunyai index yang sesuai.
*   Foreign key mesti menetapkan tindakan `cascade`, `restrict` atau `nullOnDelete` secara eksplisit.
*   Lampiran menyimpan metadata saiz, MIME type dan checksum jika diperlukan; kandungan fail kekal di private storage.
*   Token akses pelanggan mesti disimpan dalam bentuk hashed dan mempunyai tarikh luput.
*   Nama status dan priority hendaklah diuruskan melalui PHP Enum atau lookup table supaya perubahan nilai tidak memerlukan perubahan database Enum.
*   Pertimbangkan `softDeletes` untuk tiket, pengguna dan jabatan jika rekod perlu dipulihkan.
