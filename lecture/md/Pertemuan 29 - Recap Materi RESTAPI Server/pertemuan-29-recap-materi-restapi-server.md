# Pertemuan 29 - Recap Materi REST API Server

## Pendahuluan

Pada pertemuan sebelumnya kita pernah membahas konsep REST API, kenapa ada konsep ini karena website modern yang menggunakan framework Javascript memerlukan data tanpa melakukan full page refresh nah itu akan membuat halaman website lebih interaktif.

Di konsep REST API ini terdapat HTTP Code yang perlu kita hafalkan, sebenarnya secara tidak langsung kita sudah menggunakannya tetapi karena di REST API ini kita harus men-spesifikan agar bisa memberikan informasi ke Javascript lebih rinci dan padat, HTTP Code ini digunakan untuk memberikan kondisi suatu request, request merupakan suatu data kecil yang dikirim ke server untuk mendapatkan data yang di-inginkan atau sesuai data yang dikirim pertama.

REST API ini memiliki istilah Response dan Request, keduanya hampir sama mengirim informasi/data tetapi bedanya Response dikirim oleh server dan Request dikirim oleh client.

## HTTP Code

HTTP Code yang perlu di hafalkan hanya sedikit

|   Code    | Makna                           | Arti                          |
|-----------|---------------------------------|-------------------------------|
|  **200**  | *OK*                            | Request Aman                  |
|  **201**  | *Created*                       | Data berhasil dibuat          |
|  **202**  | *Accepted*                      | Data diterima                 |
|  **203**  | *Non-Authoritative Information* | Request tidak memiliki akses  |
|  **400**  | *Bad Request*                   | Data bentuknya salah          |
|  **404**  | *Not Found*                     | Halaman/Endpoint tidak ada    |
|  **500**  | *Server Error*                  | Server Error                  |

Note : Endpoint bisa dikatakan URL seperti <https://google.com>

## HTTP Method

Di konsep REST API ini juga menggunakan HTTP Method lebih banyak dibanding dengan konsep konvensional, pertemuan kemarin hanya menggunakan `GET` dan `POST`, pada dasarnya method ini digunakan untuk melakukan request tertentu, seperti `GET` untuk mengambil data, `POST` untuk mengirim data dan masih ada banyak lagi kita hanya fokus ke `GET`, `POST`, `UPDATE/PATCH`, `DELETE`.

|   Method   | Kegunaan                             |
|------------|--------------------------------------|
| **GET**    | Mengambil data                       |
| **POST**   | Men-upload data / submit formulir    |
| **UPDATE** | Men-update data yang ada di server   |
| **DELETE** | Menghapus data yang ada di server    |

## Data di Request/Response

Di request terkadang ada data yang tersimpan didalamnya biasanya sudah di Serialization, Serialization ini merupakan proses translasi suatu data menjadi data standar atau data lain. Data di request ini biasanya menggunakan format JSON mirip dengan Javascript Object, dan di server untuk mengambil data yang ada di Request harus melakukan Deserialization(Kebalikan Serialization), kenapa kok ada konsep Serialization dan Deserialization ini digunakan agar data dapat dibaca antar bahasa pemrograman bisa jadi server menggunakan bahasa selain Javascript atau PHP.

Data di request ini ada macam macam ada yang di `Header` atau di body, Header ini biasanya menyimpan meta data Request dan body ini sering menyimpan data form yang kita kirimkan.

## Header di Request/Response

Seperti di-atas Header merupakan meta data, meta data ini ada banyak sekali, yang paling sering kita gunakan nanti antara lain :

- Accept (Format apa yang di-inginkan biasanya pada header Request)
- Content-Type (Format data, terdapat di Request dan di Response)
- Authorization (Data kredensial terdapat pada Request)

Untuk `Accept` dan `Content-Type` ada banyak data mulai dari teks biasa sampai .mp4, contohnya :

- application/json
- application/javascript
- application/x-www-form-urlencoded
- application/xml
- image/gif
- image/jpeg
- image/png
- multipart/form-data
- text/css
- text/html

Karena header ini ada banyak temen temen bisa mengecek di <https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers>

## Implementasi di PHP

Di PHP kita dapat men-implementasi REST API Server tanpa kesulitan karena PHP telah membuat `function` yang dapat digunakan untuk mengatur dan mengambil HTTP Method, dan data yang ada di Request.

### HTTP Response Code

`Function` ini digunakan untuk mengatur HTTP Response Code di Response yang nanti dikirimkan, cara penggunaanya sangat simpel sekali kita tinggal memanggil `http_response_code(kode)`

Contoh dengan kode 200

```php
http_response_code(200);
```

### Header

`Function` ini digunakan untuk menambahkan header didalam Response, untuk penggunaan simpel sekali kita tinggal memanggil `function` `header(nama-header)`, `function` ini dapat dipanggil beberapa kali jadi kita bisa mengisi sebanyak meta data di Response.

Contoh mensetting `Content-Type` ke tipe `application/json`.

```php
header("Content-Type: application/json");
```

### JSON Encode dan JSON Decode

Di PHP memberikan support Serialization dan Deserialization JSON, jadi kita tidak memerlukan menginstall kode orang lain untuk mengurusi JSON, penggunaanya sangat sederhana untuk Serialization membutuhkan Array Associative dan Deserialization membutuhkan String yang berbentuk JSON, Serialization ini return String.

```php
$data = [
    'nama' => 'Zagar',
    'kelas' => 'X PPLG'
];

// Untuk Serialize
$sudahDiSerialize = json_encode($data);

// Untuk Deserialize
$sudahDiDeserialize = json_decode($sudahDiSerialize);
```

### Mengambil Data dari Request Body

Di PHP untuk mengambil data di Request Body agak sedikit berbeda dengan cara biasanya, kita bisa mengambil dengan menggunakan `function` yang digunakan untuk membuka file(anehnya) ini akan return String jadi jika Body berbentuk JSON kita bisa Deserialize.

Misalnya datanya seperti ini

```json
{
    "nama": "Zagar",
    "kelas": "X PPLG",
}
```

Dan nanti di PHP akan berbentuk seperti ini

```php
$requestBodyString = file_get_contents('php://input', true)

$hasilDeserialize = json_decode($requestBodyString);

echo $hasilDeserialize['nama'] . ' ' $hasilDeserialize['kelas'];
```

### Contoh Implementasi dengan Function Custom

Dengan menggunakan `function` bawaan kita bisa membuat `function` yang bisa membantu kita mengurangi duplikasi kode, ini sangat di rekomendasikan karena bisa mempermudah memahami maksud kode dan kalau ada error bisa di fix di satu tempat, dan kita bisa menambahkan komentar diatasnya agar lebih mudah memahaminya lagi.

Pertama Response yang menggunakan format JSON, berarti kita membutuhkan `json_encode`, `http_response_code`, dan mungkin `header`

```php
/**
 * Function yang mengirimkan data ke client dengan format json
 * dan sekalian nge-set http response code
 * @param  int   $code
 * @param  array $data
 * @param  array $header
 */
function response(int $code, array $data, array $header = [])
{
    // Kasih response code
    http_response_code($code);

    // Men-set header custom dengan menggunakan array_filter yang bermode BOTH dan memberikan
    // arrow function sebagai pengolahan data yang diberikan secara otomatis lewat array_filter
    array_filter(
        $header, fn($value, $headerType) => header($headerType . ': ' . $value),
        ARRAY_FILTER_USE_BOTH
    );

    // Nge-set Content-Type agar si client tau kalau response-nya json juga
    header("Content-Type: application/json");

    // Kita melakukan serialization data dan kita echo kan
    echo json_encode($data);
}

// Penggunaan
response(200, ['message' => 'Hello, World!'], ['Authorization' => 'Bearer token']);
```

Note : Di contoh menggunakan `arrow function` versi PHP, ini ada yang bisa ada yang tidak jadi kalau tidak bisa, bisa kembali menggunakan cara konvensional seperti ini

```php
array_filter($header, function ($value, $headerType) {
    header($headerType . ': ' $value);
}, ARRAY_FILTER_USE_BOTH);
```

Contoh ini bagus ketika digunakan pada akhir script kita jadi yang muncul nanti hanya data dari hasil Serialization-nya `json_encode` tadi.
