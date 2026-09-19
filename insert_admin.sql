-- Insert or update Administrator into users table for SQLite3
-- Note: 'role' is set to 'admin' so the user has full administrator dashboard privileges
INSERT OR REPLACE INTO users (
    id,
    name,
    username,
    email,
    role,
    email_verified_at,
    password,
    remember_token,
    created_at,
    updated_at
) VALUES (
    1,
    'Administrator',
    'adminelcoding',
    'admin@elcoding.id',
    'admin',
    NULL,
    '$2y$12$ExqZwfKoQmOcIVdmQZ25ju22esGsOz14RmxRn63v9M0alIdl/0ov.',
    NULL,
    '2026-08-19 04:27:18',
    '2026-08-19 04:27:18'
);
