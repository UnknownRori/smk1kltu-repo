<?php

require "db.php";
require "response.php";

$dataFromRequest = json_decode(file_get_contents('php://input'), true);

// Check apakah request menggunakan http method POST.
if ($_SERVER['REQUEST_METHOD'] != 'POST')
    return response(404, [
        'code' => 404,
        'message' => 'Halaman tidak ada'
    ]);

// Check apakah request mencantumkan username dan password.
if (!isset($dataFromRequest['username']) || !isset($dataFromRequest['password']))
    return response(400, [
        'code' => 400,
        'message' => 'Data kurang lengkap!'
    ]);

// Ambil data user dari database dengan nama yang sama dengan request tadi
$stmt = $pdo->prepare("SELECT * FROM users WHERE username=:username");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam('username', $dataFromRequest['username']);
$stmt->execute();
$user = $stmt->fetch();

// Check password-nya
if (password_verify($dataFromRequest['password'], $user['password'])) {
    // melakukan enkripsi username untuk membuat token
    $token = password_hash($dataFromRequest['username'], PASSWORD_DEFAULT);

    // Menambah token ke database
    $stmt = $pdo->prepare("INSERT INTO tokens (token, user_id) VALUES (:token, :user_id)");
    $stmt->bindParam('token', $token);
    $stmt->bindParam('user_id', $user['id']);
    $stmt->execute();

    response(201, [
        'code' => 201,
        'token' => $token
    ]);
} else {
    // Kalau password tidak cocok kirim http code 406 Not Acceptable
    response(406, [
        'code' => 406,
        'message' => 'Password Salah!'
    ]);
}
