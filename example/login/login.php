<?php
// Inisialisasikan session-nya (Agar bisa menggunakan fitur session)
session_start();

require './db.php';

// Check apakah user sudah pernah login/registrasi, kalau sudah pernah
// Pindah ke dashboard.php
if (isset($_SESSION['user']))
    header('Location: ./dashboard.php');

if (isset($_POST['login'])) {
    // Ambil data user dengan menggunakan data yang disubmit
    $query = $connection->prepare('SELECT * FROM users WHERE username=:username');

    // Di bind data-nya
    $query->bindParam('username', $_POST['username'], PDO::PARAM_STR);

    // Di ekseuksi query-nya lalu di fetch data-nya
    $query->execute();
    $user = $query->fetch();

    // Check apakah data yang di fetch ada atau tidak
    if ($user) {
        // Kalo user-nya ada

        // Verifikasi password
        if (password_verify($_POST['password'], $user['password'])) {
            // Kalau benar, masukan kredensi user ke session lalu pindah ke dashboard
            $_SESSION['user'] = [
                'id' => $user['userId'],
                'username' => $_POST['username'],
            ];
            header('Location: ./dashboard.php');
        } else {
            // Kalau salah
            echo "Password salah!";
        }
    } else {
        // kalo user-nya tidak ada
        echo "Username salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <!-- Menggunakan isi file navigation.php -->
    <?php require './navigation.php' ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Login" name="login">
    </form>
</body>

</html>