# Recap Materi Javascript REST API Client - Pertemuan 31

## Pendahuluan

Pada pertemuan kemarin kita memakai Postman dan Thunder Client, nah pada pertemuan kali ini kita akan menggali lebih dalam REST API di sisi client atau browser pengguna.

Javascript telah menyiapkan function yang bernama `fetch` yang bisa kita gunakan untuk mengambil dan mengirim data ke server REST API, tetapi function ini merupakan `Promise` yang berarti Asynchronous jadi kodenya akan sedikit berbeda dengan biasanya.

Sebelum itu kalau masih belum paham Closure bisa dibaca di materi pertemuan 22.

## Apa itu Asynchronous

Secara definisi Asynchronous merupakan suatu konsep untuk menajalankan suatu kepingan kode yang terpisah dengan kode yang lain, jadi normalnya kode hanya jalan 1 baris tetapi dengan adanya Asynchronous ini dapat menjalankan 2 baris kode sekaligus dengan menggunakan thread atau proccess.

Di Javascript ada konsep ini tetapi karena Javascript hanya Single Threaded ini memunculkan konsep Event Loop, ini agak kompleks tetapi intinya, kode Javascript akan menjalankan kode Asynchronous ketika ia menganggur didalam event loop dan setiap event loop bisa menjalankan kode 1 saja tetapi bisa diselipkan kode Asynchronous.

Contoh :

```javascript
function print(data) {
    console.log(data);
}

async function loop() {
    for (let i = 0; i < 100; i++) { }
}

async function myAsyncFunc() {
    print("Hello Before Loop")
    await loop()
    print("Hello After Loop");
}

myAsyncFunc();
console.log("Diluar Function");
```

Di atas akan menghasilkan output

```
Hello Before Loop
Diluar Function
Hello After Loop
```

Kenapa bisa `Diluar Function` dulu karena function `myAsyncFunc` terdapat await yang akan menunggu loop yang kita buat, karena kita menunggu kita langsung jalan keluar function dan menjalankan `console.log("Diluar Function");`

Di contoh diatas sudah ada Promise, konsep ini mirip dengan Closure tetapi sebelum menggunakan Closure kita memanggil async function tersebut lalu kita chain dengan `then` dan `catch`, `then` ketika operasi di function tersebut berhasil dan `catch` ketika gagal.

Contoh :

```javascript
const db = ["Zagar", "Alpin", "Alifah", "Ghaza", "Fauzi"];

async function dbFetch(id) {
    if (db[id]) {
        return Promise.resolve(db[id]);
    }

    return Promise.reject("Data tidak ditemukan");
}

dbFetch(1)
    .then(val => console.log(val)) // Ini akan menprint Alpin
    .catch(err => console.error(err));

dbFetch(-1)
    .then(val => console.log(val)) // Ini tidak jalan
    .catch(err => console.error(err)); // Ini akan menprint "Data tidak ditemukan"
```

Di contoh diatas ini sering disebut `method chaining`, `then` bisa di chain berkali kali karena di dalam `then` bisa saja return `Promise` yang harus ditangkap pakai `then` tetapi kalau `catch` satu saja cukup. Di contoh berikutnya kita menggunakan function yang sama tetapi ditambah for loop untuk mensimulasikan data fetching.

```javascript
async function dbFetch(id) {
    for (let i = 0; i < 200; i++) { }

    if (db[id]) {
        return Promise.resolve(db[id]);
    }

    return Promise.reject("Data tidak ditemukan");
}

dbFetch(1)
    .then(val => console.log(val))
    .catch(err => console.error(err));

console.log("Normal Code");

dbFetch(0)
    .then(val => console.log(val))
    .catch(err => console.error(err));

console.log("Normal Code");

```

Contoh diatas akan menprint

```
Normal Code
Normal Code
Alpin
Zagar
```

Kita juga bisa menambahkan keyword await untuk menunggu result data dari Promise tersebut, terkadang bisa dipakai di scope global, jeleknya ialah kode akan berhenti eksekusi sampe kode di Promise jalan.

```javascript
async function login(id) {
    const user = await dbFetch(id);
    // Do something
    return user;
}

const user = await login(1);

console.log(user);
console.log("Normal Code");
```

Note : Setiap function yang async akan return Promise secara otomatis.

## Function Fetch di Javascript

Nah kita sudah belajar dasar Asynchronous seperti apa cara kerjanya kita lanjut ke function `fetch` yang kita pakai ketika kita membuat tampilan yang interaktif tanpa ada refresh di halaman, untuk contoh ini kita menggunakan REST API orang lain.

Cara penggunaan yang paling sederhana

```html
<script>
    fetch("https://jsonplaceholder.typicode.com/todos")
        .then(respon => respon.json())
        .then(hasil => console.log(hasil))
        .catch(error => console.error(error));
</script>
```

Jadi pertama kita ambil data dari url yang dikasih didalam function `fetch`, lalu setelah berhasil kita melakukan Deserialize data menggunakan `.json()` yang nantinya memberikan kita `Promise` yang bisa kita chain lagi, kita menambah catch untuk menangkap error.

Kalau kita pengen menggunakan await didalam tag script.

```html
<script>
    (async () =>{
        const respon = await fetch("https://jsonplaceholder.typicode.com/todos")
        const hasil = await respon.json();
        console.log(hasil);
    })();
</script>
```

Kalau bingung itu maksudnya membuat Anonymous Function yang langsung dieksekusi, di contoh ini kita akan menggunakan cara biasa saja jadi tidak ada hack seperti tadi.

### Header, Method, Body

Di function fetch kita juga dapat memberikan header kepada request kita dengan memberikan Javascript Object setelah parameter URL yang digunakan untuk menkonfigurasi request kita seperti method, header, atau data kita.

```html
<script>
    fetch("https://jsonplaceholder.typicode.com/todos", {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(respon => respon.json())
        .then(hasil => console.log(hasil))
        .catch(error => console.error(error));
</script>
```

Diatas merupakan contoh penggunaanya, tetapi untuk key method kita tidak harus menspesifikan `GET` karena secara default sudah di set `GET`.

Di server REST API ini juga mensupport penambahan data, kita tinggal menambah key body yang berisi Javascript Object yang sudah di Serialize dan menganti method menjadi `GET`.

```html
<script>
    fetch("https://jsonplaceholder.typicode.com/todos", {
        method: 'POST',
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            title: 'Belajar Ngoding dan Berlogika',
            completed: 0,
            userId: 1,
        })
    })
        .then(respon => respon.json())
        .then(hasil => console.log(hasil))
        .catch(error => console.error(error));
</script>
```
