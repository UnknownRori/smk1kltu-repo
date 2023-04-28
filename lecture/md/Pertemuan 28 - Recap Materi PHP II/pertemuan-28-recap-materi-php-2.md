# Pertemuan 28 - Recap Materi PHP 2

## Pendahuluan

Pada pertemuan kemarin kita membahas, variabel, control flow, dan array di PHP, sekarang kita akan membahas `function`, `type hint`, `closure` atau `lamda function`, `class`, dan `function` bawaan yang dapat membantu manipulasi `array`.

## Function

Sama seperti Javascript, suatu block kode yang dapat dijalankan ber-ulang kali untuk mengurangi duplikasi kode.

`Function` ini dapat menerima banyak parameter, parameter ini digunakan untuk memberi data kepada `function` tersebut agar dapat diolah, parameter ini dapat digunakan seperti variabel tetapi tidak akan mengubah variabel asli dengan kata lain variabel yang diberikan di parameter itu hanya sebuah copy tetapi itu hanya untuk tipe data yang `primitive` kalau `object` akan dikasih referensi jadi apa apa yang di ubah di dalam `function` akan juga mempengaruhi yang diluar contoh :

Untuk deklarasinya seperti ini.

```php
function tambah($a, $b) {
    return $a + $b;
}

echo tambah(3, 4);
```

Dari contoh di-atas akan memberi output `7`.

### Type Hint

Di PHP kita juga dapat memberikan tipe data yang harus di ekpetasikan didalam `function` tersebut, hal ini dapat memudahkan untuk membaca `function` tersebut, dan juga agar membuat PHP akan juga melakukan konversi tipe data secara otomatis juga, jika tidak bisa akan memberikan kita `Exception` yang bisa kita `try catch`.

```php
function tambah(int $a, int $b): int {
    return $a + $b;
}
```

## Closure atau Lamda Function (Anonymous Function)

Merupakan suatu tipe `function` yang langsung dijalankan tanpa ada nama, ini sering digunakan didalam `map` suatu `array` atau di suatu `function` dll.

Contoh paling sederhana kita bisa menggunakan type `callable` didalam `function` kita untuk membuat `function` menerima `closure`.

```php
function foo(callable $bar) {
    $bar();
}

foo(function () {
    echo "Hello, World!";
});
```

## Class

`Class` itu merupakan Blueprint atau rancangan dan `class` sering digunakan untuk men-enkapsulasikan suatu data agar mudah di olah dan juga mudah dibaca, karena `Class` hanya suatu rancangan kita harus membuatnya terlebih dahulu setelah dibuat sering dipanggil `Object`, nah `Object` ini memiliki hubungan dengan `Class` yang menjadi basis pembuatan.

`Class` juga dapat memiliki `property` dan `method` tersendiri, `method` ini sama seperti `function` tetapi `this`-nya akan berkonteks kedalam class tersebut, dan `property` hanya variabel yang hidup di dalam class tersebut, setiap `class object` memiliki variabel tersendiri jadi kalau ada 2 object salah satu diganti data variabelnya tidak akan mempengaruhi yang lain, pendefinisian variabel dan method ada 2 cara, cara pertama ialah cara normal setiap object bisa memiliki value yang berbeda tetapi nama variabel/method yang sama atau yang global jadi semua yang memiliki `class` yang sama akan terpengaruh.

```php
class Motor
{
    public $tipeBensin;
    public $cc;
    public $model;
    public $tanki;

    // Method ini dipanggil ketika ada pembuatan object yang menggunakan
    // Class ini sebagai basis
    public function __construct($model, $tipeBensin, $cc, $maksTanki, $tanki)
    {
        $this->model = $model;
        $this->tipeBensin = $tipeBensin;
        $this->maksTanki = $maksTanki;
        $this->tanki = $tanki;
        $this->cc = $cc;
    }

    public function isiBensi($liter)
    {
        // Melakukan perbandingan apakah bensinya kelebihan atau tidak
        if (($liter + $this->tanki) <= $this->maksTanki) {
            $this->tanki += $liter;
        } else {
            // Kalau kelebihan tanki di-isi sesuai maks tanki
            $this->tanki = $this->maksTanki;
        }
    }

    public function jalan($km)
    {
        $this->tanki -= $km;
        echo "Telah melakukan perjalanan {$km}km!";
    }
}
// Membuat object dengan class sebagai basis
$honda = new Motor('Honda', 'Pertalite', 100, 30, 30);

// Memanggil method yang ada didalam object tersebut, ini hanya dapat dilakukan
// kalau di definisikan public
$honda->jalan(20);
$honda->isiBensi(10);

var_dump($honda); // Kita bisa men-dump semua konten didalam object
```

Di PHP `method` dan `property` harus di deklarasikan dengan keyword tambahan seperti `public` ini untuk memberi tau kalau kita bisa mengakses diluar dari class tersebut seperti yang kita lakukan ketika kita membuat object di contoh diatas, kalau masih kurang paham itu apa, bayangin aja itu seperti hak akses, jadi kalau `public` itu dapat diakses di luar, kalau `protected` dan `private` hanya dapat diakses didalam class tersebut saja, `protected` dan `private` tidak akan saya bahas secara detail terlebih dahulu karena sangat rumit, tetapi masih dapat digunakan secara normal, tetapi ada yang berbeda kalau kita sudah mulai dalam di dalam `Class`

Kalau contoh kodenya seperti ini

```php
class Honda
{
    public $cc = 100;
    protected $model = "Honda";
    private $tanki = 30;

    public getModel()
    {
        // Akses protected atau private didalam class boleh
        return $this->model;
    }
}

$honda = new Honda();

echo $honda->cc; // Ini akan jalan
echo $honda->getModel(); // Ini akan jalan
echo $honda->model; // Ini akan error
echo $honda->tanki; // Ini akan error
```

## Function bawaan untuk tipe data Array di PHP

Kita akan sering me-manipulasi `Array` di PHP dan PHP juga memberikan beberapa `function` bawaan digunakan untuk membantu kita dalam memanipulasi `Array` dengan mudah, seperti filter, map(forEach), pop, push, slice, search, dan masih banyak lagi, `function` bawaan yang digunakan untuk `Array` ini diawali `array_{nama}`.

### Map

`Function` ini bisa digunakan untuk bermacam macam, bisa untuk men-print konten `Array` atau membuat `Array` dengan hasil edit dari `Array` yang diberikan, penggunaan `Map` ini sangat banyak sekali, `Function` ini memerlukan 2 atau lebih parameter, yang paling pertama ialah `Closure` yang menerima 1 parameter yaitu `value` (isi), dan parameter sisanya ialah `Array` yang mau di `Map`.

Contoh yang paling sederhana ialah men-print semua konten di `array`.

```php
$siswa = ["Zagar", "Alpin", "Alifah", "Ghaza"];

array_map(function ($val) {
    echo $val;
}, $siswa);
```

Note : Jika ingin membuat `Array` baru dengan ini disarankan `Closure` `return` sesuatu, dan semua data di `Array` harus berhasil di `return` kalau tidak nanti ada data yang `NULL` didalam `Array` yang baru.

### Filter

`Function` ini digunakan untuk men-filter suatu array, `Function` ini sangat bermanfaat karena kita juga bisa dapat menyuruh `Function` tersebut memberikan `Key` atau Index nya, jadi tidak hanya kita mendapat isinya kita juga mendapatkan kunci atau `Index`, untuk contoh kali ini saya akan gunakan `Array` biasa dan `Associative Array` agar bisa merasakan betapa kuatnya `Function` ini.

`Filter` ini menerima 3 parameter yang pertama `Array` yang mau di loop, `Closure` yang menerima `$value` dan `$key` kalau menyalakan mode loop dengan index, dan yang terakhir `mode` mode ada dua, dan `Closure` ini disarankan return `Boolean`.

- `ARRAY_FILTER_USE_KEY` = ini membuat $value menjadi `$key` atau index.
- `ARRAY_FILTER_USE_BOTH` = Ini akan membuat `Closure` menerima 2 parameter yang pertama `$value` atau isi, lalu `$key`.

Contoh pemakaian dengan `Array` yang sederhana.

```php
$siswa = ["Zagar", "Alpin", "Alifah", "Ghaza"];


$result = array_filter($siswa, function ($value) {
    return $value == "Zagar";
});

var_dump($result);
```

Di contoh di-atas kita akan mengambil `Zagar` dan memasukannya kedalam `Array` yang baru.

Nah untuk `Array Associative` misalnya kita memiliki data seperti ini.

```php
$siswa = [
    "Zagar" => [
        "kelas" => "10 PPLG",
        "sekolah" => "SMK MUH 1 KLTU"
    ],
    "Alpin" => [
        "kelas" => "11 RPL",
        "sekolah" => "SMK MUH 1 KLTU"
    ],
    "Ghaza" => [
        "kelas" => "10 PPLG",
        "sekolah" => "SMK MUH 1 KLTU"
    ],
    "Alifah" => [
        "kelas" => "11 RPL",
        "sekolah" => "SMK MUH 1 KLTU"
    ]
];
```

Dan misalnya kita ingin mengambil data yang hanya kelas `10 PPLG`, ini dapat diselesaikan seperti ini.

```php
$result = array_filter($siswa, function ($value) {
    return $value['kelas'] == "10 PPLG";
});

var_dump($result);
```

Kita juga bisa memakai `Function` Filter ini untuk pengganti Map, misalnya kita akan menprint data dengan keynya.

```php
array_filter($siswa, function ($value, $key) {
    echo "{$key}: {$value['kelas']} <br>";
}, ARRAY_FILTER_USE_BOTH);
```

### Push dan Pop

`Function` ini hanya digunakan untuk menambah dan mengurangi data di sebuah `Array`, `push` akan menambah data ke `Array` data tersebut akan ditambah di bagian terakhir, dan `pop` akan menghapus dan akan me-return data yang tadi di hapus.

Contoh `array_pop` dengan menggunakan data di bab filter sebagai contoh.

```php
$result = array_pop($siswa);

var_dump($result);
```

Result dari `var_dump`, perlu di-ingat ini tidak akan memberikan key jadi hanya isi saja.

```php
array(2) {
  'kelas' =>
  string(6) "11 RPL"
  'sekolah' =>
  string(14) "SMK MUH 1 KLTU"
}
```

Contoh `array_push`, perlu di-ingat key-nya akan di insert secara otomatis jadi kita tidak perlu menambahi keynya, dan `function` ini bisa menerima parameter lebih dari 2, yang pertama `Array` yang mau di ditambah datanya dan yang kedua data yang kita ingin tambahkan ke `Array`.

```php
$data = [];

array_push($data, 'Zagar');
array_push($data, 'Alpin', 'Ghaza');

var_dump($data);
```

Atau bisa menggunakan bentuk seperti ini

```php
$data = [];

$data[] = "Zagar";
$data[] = "Alpin";
$data[] = "Ghaza";

var_dump($data);
```

Contoh di-atas akan menghasilkan `Array` yang berisi `['Zagar', 'Alpin', 'Ghaza']`

### Slice

`Function` ini digunakan untuk mengambil sepotong data di dalam `Array` ini memerlukan 4 parameter tetapi bisa di-isi 2 saja, parameter yang pertama `Array` yang data-nya mau diambil, parameter kedua potongan-nya mulai dari mana, parameter ketiga dipotong sampai mana, dan yang terakhir apakah key-nya di biarkan seperti itu setelah di potong.

Contoh-nya tetap menggunakan contoh data dari `Filter`.

```php
$result = array_slice($siswa, 1, 2);

var_dump($result);
```

Ini akan menghasilkan output

```php
array(2) {
  'Alpin' =>
  array(2) {
    'kelas' =>
    string(6) "11 RPL"
    'sekolah' =>
    string(14) "SMK MUH 1 KLTU"
  }
  'Ghaza' =>
  array(2) {
    'kelas' =>
    string(7) "10 PPLG"
    'sekolah' =>
    string(14) "SMK MUH 1 KLTU"
  }
}
```

### Search

`Function` ini digunakan untuk melakukan pencarian suatu data di `Array` dan jika berhasil didapatkan `Function` akan return key-nya, `Function` ini membutuhkan 3 parameter, tetapi bisa di-isi 2 saja, parameter pertama ialah data yang ingin dicari, yang kedua ialah `Array` sebagai data-nya, dan parameter terakhir mode `strict` atau tidak.

```php
$data = ["Zagar", "Alpin", "Ghaza"];

$result = array_search("Alpin", $data);

var_dump($result); // ini akan return 1
```
