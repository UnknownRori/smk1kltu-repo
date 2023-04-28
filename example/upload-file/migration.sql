-- @block ! Create new Table for storing photo
CREATE TABLE IF NOT EXISTS photo (
    photoID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL UNIQUE
);
-- @block ! TRUNCATE table photo
TRUNCATE TABLE photo;
-- @block ! Drop table photo if exists
DROP TABLE IF EXISTS photo;