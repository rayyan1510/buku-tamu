<?php

$conn = mysqli_connect('localhost', 'root', '', 'buku_tamu');

if ($conn == true) {
    # code...
    echo "Berhasil terkoneksi";
}
echo "<br>";
var_dump($conn);
