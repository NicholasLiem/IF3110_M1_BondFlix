-- 001_create_users_table.sql

-- Create the "users" table
CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(100) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT false,
    is_subscribed BOOLEAN NOT NULL DEFAULT false
);