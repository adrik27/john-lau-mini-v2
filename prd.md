# Product Requirements Document (PRD)
**Project Name:** john_lau_mini_v2 - Automated Expense Tracker (Enterprise Architecture)
**Status:** In Progress
**Platform:** Google Chat Workspace / Web

## 1. Tujuan Produk
Membangun asisten bot cerdas di Google Chat yang mampu menerima laporan pengeluaran (teks dan gambar struk), mengekstrak informasi krusial menggunakan AI, dan menyimpannya secara otomatis ke database terpusat serta menampilkannya di Google Sheets, tanpa risiko *timeout* (jeda waktu habis) dari server.

## 2. Arsitektur Sistem (Alur Kerja)
1. **Google Chat:** Antarmuka utama.
2. **VPS Server & Webhook:** Menerima pesan instan dari Google Chat dan langsung membalas "200 OK" (menggunakan Laravel Queue).
3. **Sistem Antrean (Supervisor):** Memproses antrean pesan di latar belakang secara asinkron.
4. **Google Drive Attachments:** Mengunduh gambar struk menggunakan kredensial Service Account JSON.
5. **AI Extraction (Gemini):** Membaca teks dan gambar struk secara Multimodal.
6. **Supabase (PostgreSQL):** Database utama.
7. **Spreadsheet Views:** Sinkronisasi ke Google Sheets.

## 3. Spesifikasi Teknis (Tech Stack)
* **Backend Framework:** Laravel 12 (PHP 8.2)
* **Deployment:** Snapdeploy (Zero-downtime deployment)
* **Infrastructure:** VPS Server (Nginx, PHP-FPM, Supervisor)
* **Google Cloud Services:** IAM (Service Account untuk Chat API, Drive API, Sheets API)
* **AI Provider:** Google Gemini API 3.6
* **Database:** Supabase (PostgreSQL)

## 4. Kriteria Penerimaan (Acceptance Criteria)
* [ ] Bot dapat merespons "Pesan diterima" secara instan ke Google Chat tanpa menunggu proses AI selesai.
* [ ] Aplikasi Laravel berjalan stabil di VPS dan di-deploy secara otomatis melalui Snapdeploy.
* [ ] Bot mampu membaca lampiran (*attachment*) foto struk belanja yang dikirim pengguna.
* [ ] AI mampu mengenali nominal dari foto struk tersebut (Multimodal).
* [ ] Data pengeluaran otomatis muncul sebagai baris baru di Google Sheets yang ditentukan.