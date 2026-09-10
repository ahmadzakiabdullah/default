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
| `role` | Enum | Peranan: `super_admin`, `admin_jabatan`, `staf` |
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
| `assigned_to` | FK, BigInt | Merujuk kepada `users.id` (Staf yang ditugaskan) |
| `resolved_at` | Datetime | Tarikh & Masa aduan selesai (Untuk kiraan SLA) |
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
