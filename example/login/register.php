<?php
// Inisialisasikan session-nya (Agar bisa menggunakan fitur session)
session_start();

require './db.php';

// Check apakah user sudah pernah login/registrasi, kalau sudah pernah
// Pindah ke dashboard.php
if (isset($_SESSION['username']))
    header('Location: ./dashboard.php');

// Cek apakah sudah diklik register
if (isset($_POST['register'])) {
    // Kalau diklik buat query dengan menggunakan koneksi dari db.php
    // Versi Mysql
    $query = $connection->prepare(
        "INSERT INTO users (username, password) VALUES (:username, :password)"
    );

    // Versi Sqlite
    $query = $connection->prepare(
        "INSERT INTO users (userId, username, password) VALUES (:userId, :username, :password)"
    );

    // Melakukan hashing password agar lebih aman
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Di masukan value-nya

    $query->bindParam('username', $_POST['username'], PDO::PARAM_STR);
    $query->bindParam('password', $password, PDO::PARAM_STR);

    // Bind yang ini khusus untuk sqlite (Karena tidak ada auto increment)
    // $id['COUNT(*)']++;
    // $query->bindParam('userId', $id['COUNT(*)'], PDO::PARAM_INT);

    // Eksekusi query tersebut lalu cek apakah sukses atau tidak
    if ($query->execute()) {
        // Kalau sukses otomatis pindah ke dashboard.php dan disave kredensi user ke session
        // Sebelum di save ambil data user yang baru di registrasi dan diambil id-nya
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam('username', $_POST['username'], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        $_SESSION['user'] = [
            'id' => $user['userId'],
            'username' => $_POST['username'],
        ];

        header('Location: ./dashboard.php');
    } else {
        // Kalau gagal tinggal di echo agar si user tau kalau gagal
        echo "Registrasi gagal!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    <!-- Menggunakan isi file navigation.php -->
    <?php require './navigation.php' ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Register" name="register">
    </form>
</body>

</html>