-- @block ! Create users table
CREATE TABLE IF NOT EXISTS users (
    userId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);
-- @block ! Empty users table
TRUNCATE users;
-- @block ! Drop users table
DROP TABLE users;