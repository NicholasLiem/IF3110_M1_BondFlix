-- 002_create_media_table.sql

-- Create the "media" table
CREATE TABLE IF NOT EXISTS media (
    media_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    filename VARCHAR(255) NOT NULL,
    file_type VARCHAR(20) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT NOW(),
    title VARCHAR(255),
    description VARCHAR(255)
);
