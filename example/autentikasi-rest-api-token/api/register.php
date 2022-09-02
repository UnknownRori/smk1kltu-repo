<?php

require "db.php";
require "response.php";

// Ambil data dari request dan melakukan deserialization.
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

// Melakukan hash password untuk keamanan
$password = password_hash($dataFromRequest['password'], PASSWORD_DEFAULT);

// Menambah user ke database
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->bindParam('username', $dataFromRequest['username']);
$stmt->bindParam('password', $password);
$stmt->execute();

// ambil id user yang baru ditambah
$userId = $pdo->lastInsertId();

// melakukan enkripsi username untuk membuat token
$token = md5($dataFromRequest['username']);

// Menambah token ke database
$stmt = $pdo->prepare("INSERT INTO tokens (token, user_id) VALUES (:token, :user_id)");
$stmt->bindParam('token', $token);
$stmt->bindParam('user_id', $userId);
$stmt->execute();

// Lalu mengirim response dengan data user dan token-nya
response(201, [
    'code' => 201,
    'user' => [
        'id' => $userId,
        'username' => $dataFromRequest['username'],
    ],
    'token' => $token
]);
