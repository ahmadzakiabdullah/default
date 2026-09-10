# Matriks Akses (RBAC)

| Keupayaan | Super Admin | Admin Jabatan | Staf | Pelanggan |
| :--- | :---: | :---: | :---: | :---: |
| Urus pengguna dan permission | Ya | Tidak | Tidak | Tidak |
| Lihat semua jabatan | Ya | Terhad | Terhad | Jabatan aktif sahaja |
| Lihat tiket jabatan sendiri | Ya | Ya | Ya | Tiket dengan token sah |
| Lihat tiket jabatan lain | Ya | Tidak | Tidak | Tidak |
| Tukar status tiket | Ya | Ya | Mengikut permission | Tidak |
| Tugaskan staf | Ya | Ya | Tidak | Tidak |
| Lihat audit log | Ya | Mengikut jabatan | Tidak | Tidak |
| Eksport laporan | Ya | Ya | Mengikut permission | Tidak |

Kawalan ini mesti dilaksanakan melalui Spatie Permission serta Laravel Policies, bukan melalui pemeriksaan UI sahaja.
