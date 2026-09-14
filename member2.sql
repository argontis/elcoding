-- Remove old entries from users table
DELETE FROM users WHERE nomor_kartu IN ('0008191822', '0008232736', '0008165662', '0008182271', '0002215562', '0008168070', '0008213690', '0008174500', '0008183279', '0000728374', '0008193609', '0002203750', '0008582831', '0008190313');

-- Insert into new members table
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008191822', 'Talita Rizqiana Dilani', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008232736', 'Salsabila Agustina Ramadani', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008165662', 'Kaesha Sahida', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008182271', 'Nesta Sadina', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0002215562', 'Zanevi Nur Wulandari', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008168070', 'Aulia Desira', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008213690', 'Ferdi Alfiansyah', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008174500', 'Salma Aulia Dewi', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008183279', 'Mohamad Syamir Al Ghifari', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0000728374', 'Rachmad Taufik Deniarto', 'Bogor', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008193609', 'Nayla Aura Putriherdianto', 'Bogor', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0002203750', 'Iwan Nursanto Ramadhan', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008582831', 'Najwa Sukma', 'Bekasi', datetime('now'), datetime('now'));
INSERT OR IGNORE INTO members (nomor_kartu, nama, alamat, created_at, updated_at) VALUES ('0008190313', 'Cahyo Anugrah', 'Bekasi', datetime('now'), datetime('now'));
