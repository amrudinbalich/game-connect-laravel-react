/*
 This file serves as a scaffolding point of an app.
 It helps me to brainstorm and scatch future tables in the database.
 As well to define their relationships and interconnectivity between them.
*/

-- users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type ENUM('player','publisher','admin') NOT NULL DEFAULT 'player',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- user types
CREATE TABLE player_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED PRIMARY KEY, -- belongs to
    nickname VARCHAR(50),
    real_name VARCHAR(100),
    custom_url VARCHAR,
    summary TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE publisher_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED PRIMARY KEY, -- belongs to
    company_name VARCHAR(255),
    summary TEXT NOT NULL,
    website_url VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE admin_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED PRIMARY KEY, -- belongs to
    custom_name VARCHAR(50),
    summary TEXT,
    role VARCHAR(50) DEFAULT 'moderator',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- users::end

CREATE TABLE games (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    player_objective VARCHAR(255) NULL,
    mature_content_warning BOOLEAN NOT NULL DEFAULT 0,
    publisher_user_id BIGINT UNSIGNED NOT NULL, -- belongs to
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (publisher_user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE user_games (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    game_id BIGINT UNSIGNED NOT NULL,
    licence_key VARCHAR(255) NOT NULL,
    purchased_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY user_game_unique (user_id, game_id, licence_key),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE
);