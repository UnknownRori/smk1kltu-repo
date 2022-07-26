-- @block ! Create users table
CREATE TABLE IF NOT EXISTS users (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT
);
-- @block ! Create tokens table
CREATE TABLE IF NOT EXISTS tokens (
    tokenId INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    token TEXT,
    FOREIGN KEY (user_id) REFERENCES users(userId)
);
-- @block ! Create posts table
CREATE TABLE IF NOT EXISTS posts (
    postId INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    judul VARCHAR(255),
    isi TEXT,
    FOREIGN KEY (user_id) REFERENCES users(userId)
);
-- @block ! Drop users table
DROP TABLE IF EXISTS users;
-- @block ! Drop tokens table
DROP TABLE IF EXISTS tokens;
-- @block ! Drop posts table
DROP TABLE IF EXISTS posts;
-- @block ! Empty users table
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE users;
SET FOREIGN_KEY_CHECKS = 1;
-- @block ! Empty tokens table
TRUNCATE TABLE tokens;
-- @block ! Empty posts table
TRUNCATE TABLE posts;