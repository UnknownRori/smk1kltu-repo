<?php
$pdo = new PDO("mysql:host=localhost;dbname=belajar-ngoding", 'root', '');

if (isset($_POST['submit'])) {
    // siapkan nama file yang unik
    $name = uniqid("photo:");

    // simpan meta data photo ke database
    $stmt = $pdo->prepare("INSERT INTO photo (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);

    if ($stmt->execute()) {
        // kalau sukses upload file-nya ke folder yang dituju
        move_uploaded_file($_FILES["photo"]["tmp_name"], __DIR__ . "/upload/{$name}");
    }
}

if (isset($_POST["delete"])) {
    // Ambil meta data photo tadi
    $stmt = $pdo->prepare("SELECT * FROM photo WHERE photoID=:id");
    $stmt->bindParam("id", $_POST["id"]);
    $stmt->execute();
    $photoData = $stmt->fetch();

    // Setelah di ambil dihapus
    unlink(__DIR__ . "/upload/{$photoData['name']}");

    // Setelah file fisik sudah hilang hapus yang ada di database
    $stmt = $pdo->prepare("DELETE FROM photo WHERE photoID=:id");
    $stmt->bindParam("id", $_POST["id"]);
    $stmt->execute();
}

$stmt = $pdo->prepare("SELECT * FROM photo");
$stmt->execute();
$photos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Form upload file -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="photo">
        <input type="submit" value="Submit" name="submit" />
    </form>


    <!-- Foreach photos dan sekalian form untuk menghapus data -->
    <?php foreach ($photos as $photo) : ?>
        <div>
            <img width="300" height="300" src="./upload/<?= $photo['name'] ?>" alt="<?= $photo['name'] ?>">
            <form action="" method="post">
                <input type="text" name="id" value="<?= $photo["photoID"] ?>" hidden>
                <input type="submit" value="Hapus" name="delete">
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>