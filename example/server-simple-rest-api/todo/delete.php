<?php

require 'db.php';
require 'response.php';

// Check apakah yang me-request penghapusan meng-ikut sertakan id
// dan apakah http method-nya delete
if (!isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] != 'DELETE')
    response(400, [
        'code' => 400,
        'message' => 'Data id tidak ada atau http method-nya salah'
    ]);


$stmt = $pdo->prepare("DELETE FROM todo WHERE id=:id");
$stmt->bindParam('id', $_GET['id'], PDO::PARAM_INT);

if ($stmt->execute()) {
    response(200, [
        'code' => 200,
        'message' => 'Data berhasil dihapus!'
    ]);
}

response(500, [
    'code' => 500,
    'message' => 'Penghapusan data gagal!'
]);
