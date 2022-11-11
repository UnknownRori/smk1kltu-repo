# Pertemuan 26 - Recap Materi PHP

## Pendahuluan

Bahasa pemrograman PHP ini digunakan untuk membuat script di server, ini sering disebut dengan `backend`, file PHP berektensi `.php`, PHP ini merupakan bahasa hight level, jadi kita tidak memerlukan logika cukup dalam karena kebanyakan sudah diselesaikan sama PHP.

Hanya mengingat saja script php ini dapat dijalankan 2 cara yang pertama menggunakan `intepreter` dari PHP, jika melakukan installasi dengan XAMPP bisa di cek di foldernya, cara kedua menggunakan Apache yang dibawa XAMPP ini hanya dapat dilakukan kalau file php kita ditaruh didalam di htdocs didalam folder XAMPP.

Perlu di-ingat bahasa high level prinsipnya sama jadi nanti ada sesuatu yang akan sama tetapi beda cara penulisannya.

Untuk kali ini kita akan menggunakan folder `belajar_ngoding` didalam folder htdocs.

## Membuat script pertama

Untuk membuat script pertama kita buat file `index.php` didalam folder `belajar_ngoding`, kenapa `index.php`, ini akan memudahkan akses kita, script pertama kita digunakan untuk men-print teks kedalam browser, ini sering disebut keyword, keyword yang kita gunakan untuk men-print ialah `echo`, sebelum mengetik `echo` file php harus didahului dengan `<?php`.

```php
<?php

echo 'Hello, World!';
```

Perlu di-ingat kita memberikan string ke dalam keyword `echo`, kita dapat menggunakan `'` ataupun `"` keduanya sama saja hanya `"` dapat menyelipkan variabel.

Setelah diketik seperti ini, pastikan Apache menyala lalu buka browser lalu kunjungi <http://localhost/belajar_ngoding>, setelah dikunjungi nanti akan muncul teks `Hello, World!`

Karena file PHP dapat hidup berdampingan dengan HTML kita bisa menuliskannya seperti ini

```php
<?php
echo "Hello, World1!";
?>

<html>
    <body>
        <h1><?php echo "Hello, World2!" ?></h1>
    </body>
</html>
```

keyword `echo` ini ada versi pendeknya `<?= "Hello, World!" ?>` tetapi tidak bisa dipakai kalau di `<?php ?>`.

## Variabel

Untuk membuat variabel kita harus memulai dengan simbol `$` lalu nama variabel kita, nama diawali dengan huruf, variabel di PHP ini tidak perlu disepsifikan tipe data-nya tetapi masih menggunakan konsep tipe data.

```php
<?php

$variabelKu = 'Hello, World';

echo $variabelKu;
```

## Control Flow

Konsep Control Flow ini hampir sama dengan kebanyakan bahasa pemrograman yang high level, jadi sama saja hampir tidak ada perbedaannya.

### If statement

Sama dengan javascript, tidak ada perbedaannya.

```php
if(true) {
    // Kode akan selalu jalan
}

if(false) {
    // Kode tidak akan pernah jalan
}

$variabel = 4;

if($variabel > 10) {
    // Tidak akan jalan
}else if ($variabel < 10) {
    // Akan jalan
}
```

### Switch

Sama dengan yang di Javascript tidak ada perbedaanya.

```php
<?php

$animal = 'Kuda';

switch ($animal) {
    case 'Kucing':
        // Kode 
        break;
    case 'Kuda':
        // Kode
        break;
    default:
        echo "Bukan hewan!";
        break;
}
```

### While loop

sama dengan di javascript.

```php
$i = 0;

// Ini akan menjalankan block kode tersebut sampai variabel i tidak lagi dibawah 5
while ($i < 5) {
    // Melakukan kegiatan

    $i++; // Melakukan penjumlahan i = i + 1
}
```

### For loop

Sama dengan di Javascript.

```php
for($i = 0; $i < 5; $i++) {
    // Melakukan kegiatan
}
```

### Iterator / Foreach

Masih sama dengan Javascript.

```php
$myArray = ["Zagar", "Alpin", "Alifah", "Ghaza"];

foreach ($myArray as $val) {
    echo $val;
}
```

### Try Catch

Sama seperti di Javascript tetapi sedikit berbeda cara mengurusi error.

```php
<?php

try {
    throw new Exception("Error! ditangkap dengan try catch");
} catch (Exception $e) {
    echo $e->getMessage();
}
```

Di contoh di-atas akan men-print "Error! ditangkap dengan try catch".

## Associative Array

Di PHP memiliki array yang hampir mirip dengan Javascript Object, karena juga memakai Konsep Key Value Pair, Array ini sangat bermanfaat karena kita dapat memberikan nama sesuai dengan konteks datanya, dan juga memiliki fitur Iterator juga.

```php
$arrayBiasa = ['Zagar', 'Syahrial', 'Alpin', 'Akip'];

$arrayAssociative = [
    'siswa' => ['Zagar', 'Syahrial', 'Alpin', 'Akip'];
];

// Print data ArrayAssociative di key siswa dengan index 0
echo $arrayAssociative['siswa'][0];

// Print data Array biasa dengan index 0
echo $arrayBiasa[0];
```

Kita juga bisa menggunakan `foreach` di Associative Array, karena masih termasuk `Iterable`, saya tidak akan menjelaskan terlalu dalam tentang `Iterable`, tetapi sederhananya ini membuat PHP `foreach` tau apa yang harus dilakukan.

Misal kita punya bentuk data seperti ini.

```php
$dataSiswa = [
    'Zagar' => [
        'id'    => 1,
        'kelas' => '10 PPLG',
    ],
    'Alpin' => [
        'id' => 2,
        'kelas' => '11 RPL',
    ],
    'Syahrial' => [
        'id' => 3,
        'kelas' => '10 PPLG',
    ]
];

foreach ($dataSiswa as $key => $siswa) {
    echo "{$key}: {$siswa['kelas']}\n";
}
```

Contoh di-atas akan menprint

```
Zagar: 10 PPLG Alpin: 11 RPL Syahrial: 10 PPLG 
```
