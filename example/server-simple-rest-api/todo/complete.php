<?php

require 'db.php';
require 'response.php';

// Check apakah yang me-request penghapusan meng-ikut sertakan id
// dan apakah http method-nya delete
if (!isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] != 'PATCH')
    response(400, [
        'code' => 400,
        'message' => 'Data id tidak ada atau http method-nya salah'
    ]);

$true = true;

$stmt = $pdo->prepare("UPDATE todo SET selesai=:selesai WHERE id=:id");
$stmt->bindParam('selesai', $true, PDO::PARAM_BOOL);
$stmt->bindParam('id', $_GET['id'], PDO::PARAM_INT);

if ($stmt->execute()) {
    response(200, [
        'code' => 200,
        'message' => 'berhasil!'
    ]);
}

response(500, [
    'code' => 500,
    'message' => 'gagal!'
]);
