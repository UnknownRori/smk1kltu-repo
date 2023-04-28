<?php

// Kita include db.php karena kedua file yang nanti kita include membutuhkan database juga
// Kita juga include response.php karena kita tidak ingin duplikasi kode
require "db.php";
require "response.php";

// Ambil Request HTTP Method
$method = $_SERVER['REQUEST_METHOD'];


// Check apakah method-nya tadi POST kalau ya include create.php
// Karena implementasi create todo ada di create.php
if ($method == "POST") {
    require "create.php";


    // Jika method-nya GET include get.php karena implementasi pengambilan data ada di get.php
} else if ($method == "GET") {
    require "get.php";

    // Kalau semua tidak cocok beri 404
} else {
    return response(404, [
        'code' => 404,
        'message' => "Halaman tidak ada"
    ]);
}
