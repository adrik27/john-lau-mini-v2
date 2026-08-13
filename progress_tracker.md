# 📍 TRACKER PROYEK: john_lau_mini_v2 (Local Enterprise Simulation)

**Status Saat Ini:** Fase 2 - Langkah 5 (Capture Attachment dari Chat)

### Fase 0: Fondasi Proyek
- [x] Selesai: Langkah 0 - Install Laravel 12 fresh (`john_lau_mini_v2`).
- [x] Selesai: Inisialisasi Git lokal (opsional untuk versi lokal).

### Fase 1: Membangun Sistem Asinkron (Pengganti Cloud Run & Jobs)
- [x] Selesai: Langkah 1 - Setup koneksi Supabase & migrasi tabel `jobs` (antrean) dan `expenses`.
- [x] Selesai: Langkah 2 - Buat `ProcessExpenseMessage` Job class di Laravel untuk memproses pesan di latar belakang.
- [x] Selesai: Langkah 3 - Modifikasi Webhook (`GoogleChatWebhookController`) agar merespons kilat 200 OK & memasukkan data ke Queue.
- [x] Selesai: Langkah 4 - Aktifkan Google Chat REST API menggunakan Service Account JSON & integrasikan `GoogleChatService`.

### Fase 2: Capture & Storage (Mata AI & Google Drive)
- [ ] **IN PROGRESS:** Langkah 5 - Modifikasi kode untuk menangkap attachment dari Chat.
- [ ] TODO: Langkah 6 - Integrasi Google Drive API untuk mengunggah dan menyimpan file asli.
- [ ] TODO: Langkah 7 - Integrasi Gemini AI Multimodal (Teks + Gambar).

### Fase 3: Human Confirmation & Ledger Booking
- [ ] TODO: Langkah 8 - Desain & kirim Kartu Konfirmasi (Card V2) dengan tombol interaktif ke Chat.
- [ ] TODO: Langkah 9 - Buat endpoint baru untuk menangkap aksi tombol klik dari Chat.
- [ ] TODO: Langkah 10 - Eksekusi penyimpanan ke Supabase (Source of Truth) setelah konfirmasi.
- [ ] TODO: Langkah 11 - Integrasi Google Sheets API (Ledger Views).