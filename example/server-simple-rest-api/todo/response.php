<?php

/**
 * Function yang mengirimkan data ke client dengan format json
 * dan sekalian nge-set http response code
 * @param  int   $code
 * @param  array $data
 */
function response(int $code, array $data)
{
    // Kasih response code
    http_response_code($code);

    // Nge-set Content-Type agar si client tau kalau response-nya json juga
    header("Content-Type: application/json");

    // Kita melakukan serialization data dan kita echo kan
    echo json_encode($data);

    // Lalu kita stop eksekusi php-nya
    die;
}
