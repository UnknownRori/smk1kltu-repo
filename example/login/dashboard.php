<?php
// Inisialisasikan session-nya (Agar bisa menggunakan fituer session)
session_start();

// Check apakah user sudah pernah login/registrasi, kalau belom
// Pindah ke login.php
if (!isset($_SESSION['user']))
    header('Location: ./dashboard.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <?php require './navigation.php' ?>
    Hai <?= $_SESSION['user']['username'] ?>!
</body>

</html>