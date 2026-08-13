# Product Requirements Document (PRD)
**Project Name:** john_lau_mini_v2 - Automated Expense Tracker (Local Enterprise Architecture)
**Status:** In Progress
**Platform:** Google Chat Workspace / Web

## 1. Tujuan Produk
Membangun asisten bot cerdas di Google Chat yang beroperasi dengan skema asinkron. Sistem akan menangkap laporan pengeluaran beserta foto struk, menyimpannya di Google Drive, menggunakan AI untuk ekstraksi data, dan meminta **Konfirmasi Manusia** sebelum menyimpannya ke database Supabase dan Google Sheets.

## 2. Arsitektur Sistem (Alur Kerja)
Sistem meniru alur "Proof-to-Ledger" menggunakan komponen lokal:
1. **Google Chat (Primary Interface):** Tempat interaksi utama pengguna.
2. **Ngrok & Laravel Webhook (Capture):** Menangkap *event* pesan secara instan, merespons kilat (200 OK), dan meneruskannya ke antrean lokal (Laravel Queue).
3. **Background Worker (Laravel Queue):** Memproses antrean pekerjaan di latar belakang.
4. **Google Drive (File Storage):** Mengunduh dan menyimpan dokumen/struk asli secara permanen.
5. **AI Extraction (Gemini Multimodal):** Menentukan target transaksi dari teks dan nominal pada gambar struk.
6. **Human Confirmation:** Mengirimkan *Interactive Card* ke Google Chat untuk meminta persetujuan eksekusi.
7. **Supabase (Source of Truth):** Menyimpan status, riwayat *event*, dan data final yang disetujui.
8. **Spreadsheet (Human-Facing Ledger):** Menampilkan buku besar yang mudah dibaca.

## 3. Spesifikasi Teknis (Tech Stack)
* **Backend Framework:** Laravel 12 (PHP 8.2)
* **Environment:** Localhost dengan Ngrok
* **Asynchronous Engine:** Laravel Queue (Database Driver)
* **Google Cloud Services:** IAM (Service Account untuk Chat API, Drive API, Sheets API)
* **AI Provider:** Google Gemini API
* **Database:** Supabase (PostgreSQL)

## 4. Kriteria Penerimaan (Acceptance Criteria)
* [ ] Webhook mampu memberikan respons asinkron ("Pesan diterima") secara instan (0 timeout).
* [ ] File lampiran (struk) berhasil diunduh dari Chat dan diunggah secara aman ke Google Drive.
* [ ] Gemini AI berhasil mengekstrak *item_name* dan *amount* dari gabungan teks dan gambar.
* [ ] Bot berhasil memunculkan kartu konfirmasi (Card V2) dengan tombol aksi yang bisa diklik.
* [ ] Data pengeluaran hanya dicatat ke Supabase dan Google Sheets setelah tombol Konfirmasi diklik oleh pengguna.