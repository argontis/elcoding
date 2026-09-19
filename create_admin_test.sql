-- Buat Akun Admin Test untuk SQLite3
-- Password: password123 (menggunakan bcrypt hash standar Laravel)
INSERT OR REPLACE INTO users (
    name,
    username,
    email,
    role,
    password,
    created_at,
    updated_at
) VALUES (
    'Admin Tester',
    'admintest',
    'admintest@elcoding.id',
    'admin',
    '$2y$12$3Eo90gfnuvP6fBidIY9n.e/D94e0Pkh8Eiz7DLi2RAvvgf8nb0Qy.', -- password123
    datetime('now'),
    datetime('now')
);
