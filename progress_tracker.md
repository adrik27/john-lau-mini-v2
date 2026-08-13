# 📍 TRACKER PROYEK: john_lau_mini_v2

**Status Saat Ini:** Fase 1 - Langkah 1 (Setup Git & GitHub)

### Fase 0: Fondasi Proyek
- [x] Selesai: Langkah 0 - Install Laravel 12 fresh (`john_lau_mini_v2`).

### Fase 1: Persiapan Rumah Baru (VPS & Snapdeploy)
- [ ] **IN PROGRESS:** Langkah 1 - Inisialisasi Git dan dorong (push) kode ke GitHub/GitLab.
- [ ] TODO: Langkah 2 - Siapkan server VPS (Database, Nginx, PHP, Composer).
- [ ] TODO: Langkah 3 - Hubungkan Snapdeploy dengan Repositori dan VPS untuk deploy otomatis.

### Fase 2: Membangun Jalan Tol Antrean (Laravel Queue)
- [ ] TODO: Langkah 4 - Setup koneksi Database di VPS & jalankan migrasi tabel `jobs` (untuk antrean) dan `expenses`.
- [ ] TODO: Langkah 5 - Modifikasi kode webhook untuk memasukkan pesan ke Queue (mengembalikan respons kilat 200 OK).
- [ ] TODO: Langkah 6 - Setup Service Account JSON Google & kirim balasan asinkron via Chat REST API.
- [ ] TODO: Langkah 7 - Setup Supervisor di VPS agar antrean (Queue) berjalan 24/7.

### Fase 3 & 4: Mata AI & Laporan Keuangan
- [ ] TODO: Langkah 8 - Modifikasi kode untuk mengunduh lampiran gambar & kirim ke Gemini Multimodal.
- [ ] TODO: Langkah 9 - Integrasi Google Sheets API.