<?php

require "db.php";
require "response.php";

// Check apakah request menggunakan http method POST.
if ($_SERVER['REQUEST_METHOD'] != 'POST')
    return response(404, [
        'code' => 404,
        'message' => 'Halaman tidak ada'
    ]);

// Check apakah request membawa HTTP Authorization
if (!isset($_SERVER['HTTP_AUTHORIZATION']))
    return response(400, [
        'code' => 400,
        'message' => 'Data kurang lengkap!'
    ]);

// Karena Token-nya "Bearer {{Token}}"
// Kita menggunakan function explode untuk memecah string menjadi array
$token = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

$stmt = $pdo->prepare("DELETE FROM tokens WHERE token=:token");
$stmt->bindParam('token', $token[1]);
$stmt->execute();

response(200, [
    'code' => 200,
    'message' => 'Logout berhasil!'
]);
