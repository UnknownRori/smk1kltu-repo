-- @block ! Create Todo Table
CREATE TABLE IF NOT EXISTS todo(
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    selesai BOOLEAN DEFAULT FALSE
);
-- @block ! Delete Todo Table
DROP TABLE IF EXISTS todo;
-- @block ! Clear Todo Table
TRUNCATE TABLE todo;