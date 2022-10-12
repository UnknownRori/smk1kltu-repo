# Pertemuan 28 - Recap Materi PHP Mysql

## Pendahuluan

Kemarin kita sudah mendalami dasar dasar PHP, nah tetapi kita tidak bisa menggunakan instruksi/kode itu saja karena website akan dinamis dan memerlukan tempat untuk menyimpan data, paling sederhana ialah menggunakan file, tetapi kecepatan website akan menjadi sangat terbatas dengan hardware penyimpanannya (misalnya HDD yang biasanya READ/WRITE lambat), solusinya ialah menggunakan Database Server, untuk praket bisa menggunakan [XAMPP](https://www.apachefriends.org/download.html).

Nah di PHP sudah menyediakan 2 cara untuk melakukan koneksi ke Database, ada versi `Functional` atau `Procedure`, dan ada versi `Object Oriented`, nah untuk kali ini kita akan ke `Object Oriented` karena kita bisa menggunakan hal yang sama untuk melakukan koneksi ke macam jenis Database, ini berbentuk `Class PDO`.

## Desain

Sebelum kita praktek, kita siapkan dulu database, tabelnya, dan data demo, untuk nama database di contoh kita menggunakan `belajar_ngoding`.

```sql
CREATE TABLE IF NOT EXISTS siswa(
    uid INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) UNIQUE,
    alamat VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS ulangan(
    ulanganId INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    nilai INT,
    mapel VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES siswa(uid)
);

INSERT INTO siswa (nama, alamat) VALUES ("Siswa1", "Bulan");
INSERT INTO siswa (nama, alamat) VALUES ("Siswa2", "Mars");
INSERT INTO siswa (nama, alamat) VALUES ("Siswa3", "Bumi");
INSERT INTO siswa (nama, alamat) VALUES ("Siswa4", "Venus");

INSERT INTO ulangan (user_id, nilai, mapel) VALUES (1, 70, "MTK");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (1, 75, "FISIKA");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (2, 80, "BINDO");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (2, 65, "MTK");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (2, 40, "MTK");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (3, 75, "FIKIH");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (3, 95, "MTK");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (4, 60, "BINGGRIS");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (4, 45, "BINGGRIS");
INSERT INTO ulangan (user_id, nilai, mapel) VALUES (4, 75, "MTK");
```

## Penggunaan PDO

### Melakukan Koneksi

Sebelum kita menajalankan SQL kita, kita harus melakukan koneksi dengan Database terlebih dahulu, ketika kita men-inisialisasikan `Object PDO` dengan `new` kita harus memberikan 4 parameter, tetapi bisa di-isi 3 saja, parameter yang pertama ialah DSN, yang kedua ialah username di database tersebut, yang ketiga ialah password dari database tersebut, yang terakhir adalah opsi tambahan.

DSN di parameter pertama bentuknya mirip dengan yang lainnya, jadi kalau tidak tau bisa digoogle nanti muncul secara otomatis, karena kita menggunakan Mysql kita mengetik DSN-nya Mysql seperti ini `mysql:host=localhost;dbname=belajar_ngoding`

```php
$opsi_db = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO('mysql:host=127.0.0.1;dbname=belajar_ngoding', 'root', '', $opsi_db);
```

Di contoh di-atas kita akan menggunakan `opsi` agar kita bisa mengetahui kalau query SQL kita ada yang bermasalah.

### Query Pertama

`PDO` Memiliki banyak sekali `method` yang bisa kita pakai, `method` yang pertama ialah `query`, `method` ini bisa menjalankan query SQL yang kita definisikan.

Contoh paling sederhana mengambil seluruh data dari tabel siswa, perlu di-ingat `$pdo` sama dengan yang di-atas

```php
// Membuat query SQL
$query = $pdo->query("SELECT * FROM siswa");

// Ini akan membuat pengambilan data kita menggunakan Associative Array
$query->setFetchMode(PDO::FETCH_ASSOC);

// Menjalankan query
$query->execute();

// Mengambil semua data yang ada
$data = $query->fetchAll();

// Lalu kita print semua data tersebut
var_dump($data);
```

Setelah melihat contoh di-atas method `query` ini mengembalikan sebuah object `PDOSTATEMENT` yang bisa kita gunakan untuk mengambil data, sebelum memulai mengambil data, kita harus jalankan method `execute` terlebih dahulu, baru bisa kita ambil dengan menggunakan `fetchAll`

Kita juga bisa melakukan pengambilan data yang spesifik misalnya kita ingin `uid` 1 didalam tabel siswa, ini dapat di selesaikan dengan menggunakan perintah SQL `WHERE`.

```php
$query = $pdo->query("SELECT * FROM siswa WHERE uid=1");

// Ini akan membuat pengambilan data kita menggunakan Associative Array
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();

// Bedanya dengan fetchAll ialah, kalau fetch hanya 1 yang di-ambil
$data = $query->fetch();

var_dump($data);
```

Nah penggunaan method `query` ini ada bagus sama buruknya, bagusnya ialah kita bisa cepat membuat query tanpa susah susah memikirkan hal lain, tetapi buruknya ialah kita akan menjadi rawan terkena `hack` untuk mengurangi kejadian ini kita menggunakan cara `prepared statement`.

Jadi semisal kita punya input yang akan di masukan kedalam query SQL kita seperti contoh dibawah.

```php
// Bayangkan ini dari input user
$inputUser = 2;

$query = $pdo->query("SELECT * FROM siswa WHERE uid={$inputUser}");

// Ini akan membuat pengambilan data kita menggunakan Associative Array
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();

$data = $query->fetch();

var_dump($data);
```

Nah contoh di-atas dapat membuat kita kena `hack`, jenis hack disini ialah `SQL Injection` karena kita bisa saja sebagai user langsung meng-input SQL karena input kita langsung dimasukan ke query SQL-nya server dan langsung dijalankan tanpa ada pertanyaan.

### Prepared Statement

Prepared Statement ini beda jauh dengan method `query` karena kita harus mendefinisikan SQL tanpa ada penambahan dari luar kalau ada penambahan dari luar kita harus menggunakan simbol `:`.

Sebagai contoh kita masih sama ingin mengambil data `uid` dengan input user.

```php
$userInput = 2;

$query = $pdo->prepare("SELECT * FROM siswa WHERE uid=:uid");

$query->setFetchMode(PDO::FETCH_ASSOC);

$query->bindParam('uid', $userInput, PDO::PARAM_INT);

$query->execute();

$data = $query->fetch();

var_dump($data);

```

Perbedaan-nya terlihat sekali didalam query SQL yang kita definisikan dan method yang kita panggil sebelum di jalankan method `execute`, method `bindParam` digunakan untuk pengantian suatu teks yang menggunakan `:` di awalnya, dan parameter terakhir adalah tipe data-nya

Tipe data yang ada didalam PDO

- PDO::PARAM_BOOL
- PDO::PARAM_INT
- PDO::PARAM_STR
- PDO::PARAM_STR_CHAR

method `bindParam` dapat dipanggil berulang kali jadi kita tidak perlu khawatir.

### Pengaksesan Data

Karena data yang kita ambil berbentuk Array kita bisa mengaksesnya seperti Array biasa, misalnya data yang di ambil menggunakan method `fetch` dapat diakses menggunakan nama kolom tersebut, misalnya menggunakan query di-atas tadi.

```php
echo "Nama   : {$data['nama']}";
echo "Alamat : {$data['alamat']}";
```

Dan untuk data yang di ambil menggunakan method `fetchAll` kita harus menggunakan index angka karena data lebih dari satu, bisa juga kita menggunakan loop.

```php
foreach ($data as $siswa) {
    echo "Nama   : {$siswa['nama']}";
    echo "Alamat : {$siswa['alamat']}";
}
```

Atau kita bisa menprint dengan menggunakan HTML agar lebih enak.

```php
<?php foreach ($data as $siswa) : ?>
    <h1><?= $siswa['nama'] ?></h1>
    <p><?= $siswa['alamat'] ?></p>
<?php endforeach; ?>
```

### JOIN Table

Untuk table join disini tetap sama ketika kita memakai SQL langsung di cmd, hanya saja perbedaannya kita akan mengolah data tersebut.

Misalnya tabel join dari ulangan dengan siswa tetapi yang hanya memiliki ulangan saja, lalu di print ke browser

```php
$query = $pdo->prepare("SELECT * FROM ulangan LEFT JOIN siswa ON ulangan.user_id = siswa.uid");

$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();

$data = $query->fetchAll();
```

```php
<?php foreach ($data as $ulangan) : ?>
    <h2>Mapel : <?= $ulangan['mapel'] ?></h2>
    <p>Nilai : <?= $ulangan['nilai'] ?></p>
    <span>Milik : <?= $ulangan['nama'] ?></span>
<?php endforeach; ?>
```

#### Kode full

```php
<?php

$pdo = new PDO('mysql:host=127.0.0.1;dbname=belajar_ngoding', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$userInput = 2;

$query = $pdo->prepare("SELECT * FROM ulangan LEFT JOIN siswa ON ulangan.user_id = siswa.uid");

$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();

$data = $query->fetchAll();

var_dump($data);

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
</body>
<?php foreach ($data as $ulangan) : ?>
    <h2>Mapel : <?= $ulangan['mapel'] ?></h2>
    <p>Nilai : <?= $ulangan['nilai'] ?></p>
    <span>Milik : <?= $ulangan['nama'] ?></span>
<?php endforeach; ?>

</html>
```
