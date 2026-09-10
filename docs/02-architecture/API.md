# Kontrak API Awal

Jika API diperlukan untuk integrasi atau frontend tambahan, endpoint minimum ialah:

| Method | Endpoint | Tujuan |
| :--- | :--- | :--- |
| POST | `/api/tickets` | Hantar tiket guest |
| POST | `/api/tickets/lookup` | Semak tiket dengan token sah |
| POST | `/api/tickets/{ticket}/replies` | Tambah balasan pelanggan |
| GET | `/api/admin/tickets` | Senarai tiket staf yang dibenarkan |
| PATCH | `/api/admin/tickets/{ticket}` | Kemas kini status/assignment |

Semua endpoint mesti menggunakan validation, rate limiting, authorization policy, pagination dan format error yang konsisten.
