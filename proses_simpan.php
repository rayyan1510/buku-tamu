<?php

// include penyimpanand

var_dump($_POST);


// cek jika ada di set $_post
if (isset($_POST) == true) {

    $nama_tamu = htmlspecialchars($_POST['nama_tamu']);
    $no_telp = htmlspecialchars($_POST['no_telp']);

    $$pekerjaan;

    echo "<br>true";
} else {
    echo "<br>true";
}
