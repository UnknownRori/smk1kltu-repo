# === Permasalahan ===

Terkadang ketika kita membuat website dengan Javascript/Typescript kita membutuhkan data dari server, dan server itu tadi meminta kredensi user agar bisa melakukan pengolahan data, hal ini masih bisa dilakukan di RESTFUL API tetapi dengan menggunakan sistem Token Based Authentication (Autentikasi berbasis token), Jadi  ketika si user melakukan login Javascript/Typescript kita mengirimkan data login tadi ke server lalu setelah autentikasi berhasil server akan memberikan response access token yang nanti bisa digunakan untuk akses di server yang memerlukan autentikasi.

Token Based Authentication ini beda dengan JSON Web Token karena Token Based Authentication si server juga menyimpan token tadi, kalau pengguna github pasti kalau nge-cek di settings ada nama-nya "personal access token" nah Token Based Authentication mirip seperti itu.

Cara membuat token untuk Token Based Authentication itu sangat bermacam-macam hal yang paling mudah ialah membuat token menggunakan versi hash username si user jika username user itu unik dan tidak ada yang sama di dalam database.

Untuk pengiriman token ini di javascript kita menggunakan Authorization Header lalu kita isi Bearer {{ TOKEN }}, lalu di server harus melakukan parsing dulu di Authorization Header request-nya tadi lalu ngambil token itu tadi, lalu di verifikasi kalau itu memang betul token-nya.

Karena token juga di simpan di server jadi kita harus menyiapkan tabel yang digunakan untuk menyimpan token
tersebut, dan memiliki relasi dengan tabel user.

Hal pertama yang akan kita lakukan membuat tabel users lalu baru si tokens

```sql
-- @block ! Create users table
CREATE TABLE IF NOT EXISTS users (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT
);
-- @block ! Create tokens table
CREATE TABLE IF NOT EXISTS tokens (
    tokenId INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    token TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

Setelah itu untuk demonstrasi penggunaan token itu tadi kita bisa menggunakan tabel satu lagi yaitu tabel posts, dan juga kita akan mengikuti standar RESTFUL API sepenuh-nya

```sql
-- @block ! Create posts table
CREATE TABLE IF NOT EXISTS posts (
    postId INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    judul VARCHAR(255),
    isi TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

Schema yang nanti kita buat RESTFUL Server, untuk {{ BASE_URI }} bisa menyesuaikan, dan {{ TOKEN }} menyesuaikan dengan token yang diberikan oleh server.
``` json
### Melakukan request ke server untuk registrasi user
POST http://{{BASE_URI}}/api/login.php HTTP/1.1
Content-Type: application/json

Request : 

{
    "name": "Zagar",
    "password": "password"
}

Response : 

{
    "code": 200,
    "token": "xxx"
}


### Melakukan request ke server untuk mendapatkan token
POST http://{{BASE_URI}}/api/register.php HTTP/1.1
Content-Type: application/json

Request : 

{
    "name": "Zagar",
    "password": "password"
}

Response : 

{
    "code": 201,
    "user": {
        "id": xxx,
        "username": "Zagar"
    },
    "token": "xxx"
}

### Melakukan request ke server untuk registrasi user
POST http://{{BASE_URI}}/api/logout.php HTTP/1.1
Authorization: Bearer {{TOKEN}}

Request : 

{

}

Response : 

{
    "code": 200,
    "message": "Logout berhasil!"
}

### Melakukan penambahan data di database dengan token itu tadi
POST http://{{BASE_URI}}/api/posts.php HTTP/1.1
Content-Type: application/json
Authorization: Bearer {{TOKEN}}

Request : 

{
    "judul": "xxx",
    "isi": "xxx"
}

Response : 

{
    "code": 201,
    "post": {
        "id": xxx,
        "judul": "xxx",
        "isi": "xxx"
    }
}

### Mengambil semua posts
GET http://{{BASE_URI}}/api/posts.php HTTP/1.1

Request : 

{

}

Response : 

{
    "code": 200,
    "posts": [
        {
            "id": xxx,
            "judul": "xxx",
            "isi": "xxx"
        },
        {
            "id": xxx,
            "judul": "xxx",
            "isi": "xxx"
        }
        ...
    ]
}
```

Untuk susunan file
1. /folder-di-htdocs/api/db.php
2. /folder-di-htdocs/api/login.php
3. /folder-di-htdocs/api/register.php
4. /folder-di-htdocs/api/posts.php
5. /folder-di-htdocs/api/response.php

Untuk response.php bisa menggunakan yang praktek-nya RESTFUL API yang dulu