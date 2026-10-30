-- SIM Data Mahasiswa: skrip database (MySQL / MariaDB)
-- Import lewat phpMyAdmin atau HeidiSQL (Laragon), atau lewat terminal:
--   mysql -u root < database.sql

CREATE DATABASE IF NOT EXISTS sim_mahasiswa
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE sim_mahasiswa;

DROP TABLE IF EXISTS mahasiswa;
DROP TABLE IF EXISTS users;

-- Tabel akun pengelola (untuk login)
CREATE TABLE users (
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username   VARCHAR(50)  NOT NULL,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel data mahasiswa
CREATE TABLE mahasiswa (
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nim        VARCHAR(15)  NOT NULL,
    nama       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    jurusan    VARCHAR(50)  NOT NULL,
    angkatan   SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_mahasiswa_nim (nim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Akun pengelola: username "admin", password "admin123" (disimpan sebagai hash bcrypt)
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$te1VEiqyHY24.O86aGdDg.9HAvZxB998bRQRYoZ2k7wlgMmLwSLsW');

-- Data awal mahasiswa
INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES
('2301001', 'Budi Santoso',     'budi.santoso88@gmail.com',     'Teknik Informatika', 2023),
('2301002', 'Siti Nurhaliza',   'siti.nurhaliza21@gmail.com',   'Sistem Informasi',   2023),
('2301003', 'Putri Anggraini',  'putri.anggraini07@gmail.com',  'Manajemen',          2023),
('2201004', 'Andi Pratama',     'andi.pratama99@gmail.com',     'Teknik Elektro',     2022),
('2201005', 'Dewi Lestari',     'dewilestari.id@gmail.com',     'Akuntansi',          2022),
('2201006', 'Fajar Nugroho',    'fajar.nugroho14@gmail.com',    'Teknik Informatika', 2022),
('2101007', 'Rizky Maulana',    'rizkymaulana.r@gmail.com',     'Sistem Informasi',   2021),
('2101008', 'Nadia Rahmawati',  'nadia.rahmawati03@gmail.com',  'Akuntansi',          2021);
