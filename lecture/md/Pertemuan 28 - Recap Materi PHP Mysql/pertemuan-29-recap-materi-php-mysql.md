# Pertemuan 29 - Recap Materi PHP Mysql

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

$pdo = new PDO('mysql:host=127.0.0.1;dbname=belajar_ngoding', 'root', 'unknownrori', $opsi_db);
```

Di contoh di-atas kita akan menggunakan `opsi` agar kita bisa mengetahui kalau query SQL kita ada yang bermasalah.

### Query Pertama
