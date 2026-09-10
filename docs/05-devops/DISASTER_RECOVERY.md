# Backup dan Disaster Recovery

## Skop Backup

Backup merangkumi database, private attachment storage, konfigurasi deployment yang tidak mengandungi secret, dan fail penting aplikasi.

## Keperluan Minimum

* Backup database harian dengan retention yang dipersetujui.
* Salinan backup di lokasi berasingan dan encryption at rest.
* Ujian restore sekurang-kurangnya setiap suku tahun.
* Akses backup dihadkan kepada pasukan IT yang diberi kuasa.
* Rekodkan RPO dan RTO selepas dipersetujui bersama pemilik sistem.

## Prosedur Insiden

1. Kenal pasti skop kegagalan dan hentikan deployment yang sedang berjalan.
2. Pulihkan database dan attachment daripada backup terbaru yang sah.
3. Jalankan migration, health check dan smoke test.
4. Sahkan integriti tiket, attachment, queue dan notifikasi.
5. Rekodkan punca, masa pemulihan dan tindakan pencegahan.
