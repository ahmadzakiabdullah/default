# Kriteria Penerimaan dan Definition of Done

## Kriteria Umum

Setiap ciri mesti mempunyai acceptance criteria yang boleh diuji, permission yang jelas, validasi input, keadaan ralat dan sokongan Bahasa Melayu/Bahasa Inggeris.

## Contoh: Hantar Tiket

* Pelanggan boleh menghantar borang dengan semua medan wajib yang sah.
* CAPTCHA, rate limit dan validasi lampiran diperiksa sebelum rekod disimpan.
* Sistem menjana `Tracking ID` unik dan memaparkannya sekali kepada pelanggan.
* E-mel pengesahan dihantar melalui queue.
* Tiket, audit log dan lampiran disimpan secara transaction-safe.

## Contoh: Tukar Status

* Hanya pengguna dengan permission yang sesuai boleh menukar status.
* Perubahan status menghasilkan sejarah status dan audit log.
* `resolved_at` dan `closed_at` dikemas kini mengikut status.
* Pelanggan menerima notifikasi jika konfigurasi e-mel aktif.

## Definition of Done

Kod, migration, localization, ujian automatik, dokumentasi, security review dan deployment notes mesti lengkap. Semua CI quality gates mesti lulus.
