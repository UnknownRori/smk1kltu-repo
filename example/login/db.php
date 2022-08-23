<?php
// Versi Mysql
// biasanya username-nya itu root lalu password-nya kosong
$connection = new PDO('mysql:host=localhost;dbname=ngoding', 'username-nya', 'password-nya');


// Versi Sqlite Memory daripada yang file (Memory > File)
// $connection = new PDO('sqlite::memory:', null, null, [
//     PDO::ATTR_PERSISTENT => true
// ]);

// // Karena sqlite tidak ada table, query di migration.sql tidak akan melakukan tabrakan
// // Tapi karena sqlite tidak mempunyai fitur AUTO_INCREMENT jadi harus implementasi sendiri
// $query = $connection->query(
//     "CREATE TABLE IF NOT EXISTS users (
//         userId INT NOT NULL PRIMARY KEY,
//         username VARCHAR(255) UNIQUE,
//         password VARCHAR(255)
//     );"
// );


// $query->execute();

// // Karena tidak ada fitur AUTO_INCREMENT kita buat AUTO INCREMENT sendiri.
// $query = $connection->query(
//     "SELECT COUNT(*) FROM users;"
// );

// $query->execute();
// $id = $query->fetch();
