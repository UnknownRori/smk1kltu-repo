<?php

$dataFromRequest = json_decode(file_get_contents('php://input'), true);

// Check apakah data yang kita butuhkan ada
if (!isset($dataFromRequest['judul']))
    return response(400, ['code' => 400, 'message' => 'Tidak ada judul!']);

$judul = $dataFromRequest['judul'];

// Melakukan penambahan data ke database
$stmt = $pdo->prepare("INSERT INTO todo (judul) VALUES (:judul)");
$stmt->bindParam("judul", $judul, PDO::PARAM_STR);

// Cek apakah eksekusi berhasil atau tidak
if ($stmt->execute()) {

    // Ambil data yang baru di tambah dengan menggunakan ORDER BY (menurut urutan) DESC (Descending/dari yang paling besar)
    // Lalu kita limit data yang kita ambil 1
    $stmt = $pdo->query("SELECT * FROM todo ORDER BY id DESC LIMIT 1");
    $stmt->setFetchMode(PDO::FETCH_ASSOC); // Ini agar si pdo tidak me-return array key angka
    $stmt->execute();
    $data = $stmt->fetch();

    response(201, [
        'code' => 201,
        'message' => "Data berhasil di tambah",
        'todo' => $data
    ]);
}

// Kalau tidak kasih response code 500
response(500, [
    'code' => 500,
    'message' => "Kesalahan Server"
]);
