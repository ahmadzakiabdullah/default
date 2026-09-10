# Kitar Hayat Tiket

```text
baru -> terbuka -> dalam_tindakan -> selesai -> ditutup
                    |       ^          |
                    +-------+          +-> dibuka semula jika maklumat tambahan diperlukan
```

## Peraturan Transisi

| Dari | Ke | Syarat |
| :--- | :--- | :--- |
| `baru` | `terbuka` | Tiket diterima dan boleh diproses |
| `terbuka` | `dalam_tindakan` | Staf mula mengurus tiket |
| `dalam_tindakan` | `selesai` | Penyelesaian direkodkan |
| `selesai` | `ditutup` | Pelanggan dimaklumkan atau tempoh auto-close tamat |
| `selesai` | `terbuka` | Pelanggan membalas atau tiket dibuka semula |

Setiap transisi mesti memeriksa authorization, merekod actor, timestamp, sebab perubahan dan audit log.
