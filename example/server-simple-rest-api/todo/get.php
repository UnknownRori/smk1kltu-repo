<?php

// Mengambil semua data di tabel todo
$stmt = $pdo->prepare("SELECT * FROM todo");
$stmt->setFetchMode(PDO::FETCH_ASSOC); // Ini agar si pdo tidak me-return array key angka
$stmt->execute();
$data = $stmt->fetchAll();

// Lalu kita berikan hasil-nya ke user lewat function response yang kita buat
response(200, [
    'code' => 200,
    'data' => $data
]);
