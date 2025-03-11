<?php

require("config/config.default.php");
require("config/config.function.php");
require("config/functions.crud.php");

function create_random($length)
{
    $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data) - 1);
        $string .= $data[$pos];
    }
    return $string;
}
$token = create_random(6);
$now = date('Y-m-d H:i:s');
echo $token;
$cek = rowcount($koneksi, 'token');
if ($cek <> 0) {
    $query = fetch($koneksi, 'token');
    $time = $query['time'];
    $tgl = buat_tanggal('H:i:s', $time);
    $exec = update($koneksi, 'token', ['token' => $token, 'time' => $now], ['id_token' => 1]);
} else {
    $exec = insert($koneksi, 'token', ['token' => $token, 'masa_berlaku' => '02:30:00']);
}


?>