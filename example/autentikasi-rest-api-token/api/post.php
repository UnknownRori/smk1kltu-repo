<?php

require "db.php";
require "response.php";

// Cek apakah http request method-nya post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek apakah memiliki HTTP Authorization
    if (!isset($_SERVER['HTTP_AUTHORIZATION']))
        response(203, [
            'code' => 203,
            'message' => 'Token salah!'
        ]);

    // Olah HTTP Authorization dan ambil token-nya
    $token = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    // Ambil token di database sesuai dengan data yang diberikan
    $stmt = $pdo->prepare("SELECT * FROM tokens WHERE token=:token");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam('token', $token[1]); // Karena token-nya di index 1
    $stmt->execute();
    $token = $stmt->fetch();

    // Kalau token di database tidak ada langsung response token salah
    if (!$token)
        response(203, [
            'code' => 203,
            'message' => 'Token salah!'
        ]);

    // Melakukan deserialize data request
    $dataFromRequest = json_decode(file_get_contents('php://input'), true);

    // Cek apakah data request telah memenuhi yang nanti kita butuhkan untuk
    // Membuat data
    if (!isset($dataFromRequest['judul']) || !isset($dataFromRequest['isi']))
        response(400, [
            'code' => 400,
            'message' => 'Data kurang lengkap'
        ]);

    // Melakukan penambahan data posts ke database
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, judul, isi) VALUES (:user_id, :judul, :isi)");
    $stmt->bindParam('user_id', $token['user_id']);
    $stmt->bindParam('judul', $dataFromRequest['judul']);
    $stmt->bindParam('isi', $dataFromRequest['isi']);
    $stmt->execute();

    // Memberikan response balik ke request
    response(201, [
        'code' => 201,
        'post' => [
            'id' => $pdo->lastInsertId(),
            'user_id' => $token['user_id'],
            'judul' => $dataFromRequest['judul'],
            'isi' => $dataFromRequest['isi'],
        ]
    ]);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Jika request http method-nya GET berikan semua data dari database posts
    $stmt = $pdo->prepare("SELECT * FROM posts");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $posts = $stmt->fetchAll();

    response(200, [
        'code' => 200,
        'posts' => $posts
    ]);
}

// Kalau semua tidak ada kirim 404
response(404, [
    'code' => 404,
    'message' => 'Halaman tidak ada'
]);
