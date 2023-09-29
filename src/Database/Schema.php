<?php
namespace Database;

class Schema {
    public static $usersTableSchema = "
    CREATE TABLE IF NOT EXISTS users (
        user_id SERIAL PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password_hash VARCHAR(100) NOT NULL,
        is_admin BOOLEAN NOT NULL DEFAULT false
    )";

    public static $mediaTableSchema = "
    CREATE TABLE IF NOT EXISTS media (
        media_id SERIAL PRIMARY KEY,
        user_id INT REFERENCES users(user_id),
        filename VARCHAR(255) NOT NULL,
        file_type VARCHAR(20) NOT NULL,
        uploaded_at TIMESTAMP DEFAULT NOW(),
        title VARCHAR(255),
        description VARCHAR(255)
        )
    ";

    public static $contentTableSchema = "
    CREATE TABLE IF NOT EXISTS content (
        content_id SERIAL PRIMARY KEY,
        title VARCHAR(100) UNIQUE NOT NULL,
        description VARCHAR(255) NOT NULL,
        release_date DATE NOT NULL,
        filename VARCHAR(255) NOT NULL
    )
    ";
}
