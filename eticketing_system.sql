-- helpdesk1 DB
DROP DATABASE IF EXISTS eticketing_system;
CREATE DATABASE eticketing_system DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE eticketing_system;
CREATE TABLE tickets (
 id INT AUTO_INCREMENT PRIMARY KEY,
 fullname VARCHAR(150) NOT NULL,
 status_pelapor VARCHAR(50) DEFAULT NULL,
 unit VARCHAR(50) DEFAULT NULL,
 kategori VARCHAR(100) DEFAULT NULL,
 deskripsi TEXT,
 category_type VARCHAR(20) DEFAULT 'IT',
 status VARCHAR(20) DEFAULT 'Open',
 tanggal_buat DATETIME DEFAULT CURRENT_TIMESTAMP,
 jam_penanganan TIME DEFAULT NULL,
 pesan_admin TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;