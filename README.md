# 🖥️ Sistem E-Helpdesk Al Hikmah

**E-Helpdesk Al Hikmah** adalah sistem pelaporan dan manajemen tiket berbasis web yang dikembangkan untuk mendukung layanan bantuan internal, mencakup bidang **IT Support** dan **Facility Maintenance** di lingkungan **Al Hikmah IIBS Batu**.

---

## 🎯 Tujuan Pengembangan

Sistem ini bertujuan untuk:
- Menyediakan media pelaporan masalah internal secara terstruktur dan tanpa kebutuhan internet.  
- Mempercepat proses tindak lanjut dan penyelesaian tiket.  
- Memudahkan monitoring dan evaluasi performa layanan.  
- Menghasilkan laporan otomatis untuk kebutuhan dokumentasi dan audit internal.

---

## ⚙️ Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| Backend | PHP (Native) |
| Database | MySQL |
| Web Server | XAMPP / Apache |
| Frontend | HTML, CSS, JavaScript |
| Report | Export ke PDF & Excel |

---

## 👥 Role Pengguna

| Role | Deskripsi |
|------|------------|
| **Admin** | Mengelola tiket, memantau laporan, menghapus data, dan mencetak report. |
| **User** | Mengirimkan laporan atau permintaan bantuan, melihat status tiket. |

---

## 📊 Fitur Utama

- 🔹 Dashboard Admin & User  
- 🔹 Kategori Layanan (IT Helpdesk & Facility Helpdesk)  
- 🔹 Pelacakan Status Tiket (Open, In Progress, Done)  
- 🔹 Notifikasi Status  
- 🔹 Export Laporan ke Excel  
- 🔹 Hak Akses Berbasis Role  
- 🔹 Tampilan Responsif & Ringan  

---

## 🧩 Struktur Folder Proyek

ehelpdesk/
├── admin/
│ ├── dashboard.php
│ ├── report.php
│ ├── ...
├── user/
│ ├── form_tiket.php
│ ├── status.php
│ ├── ...
├── database/
│ └── ehelpdesk.sql
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
└── index.php

---

## 🧭 Cara Instalasi & Penggunaan

1. **Clone repository ini** ke dalam folder `htdocs` (XAMPP):
   ```bash
   git clone https://github.com/username/e-helpdesk.git

---

2. **Import database** buka (localhost/phpmyadmin):
  - 🔹 Buat database baru : ehelpdesk
  - 🔹 Import file : database/ehelpdesk.sql
  - 🔹 Jalankan http://localhost/ehelpdesk/

--- 

Sistem ini dikembangkan untuk kebutuhan internal AL Hikmah IIBS Batu.
Distribusi ulang tanpa izin pengembang dilarang.

👨‍💻 Pengembang

Bakhrudin Ikhwan Ansori
IT Infrastructure Specialist — AL Hikmah IIBS Batu
📧 Email: [ikhwanaan60@gmail.com]
📅 Tahun: 2025

