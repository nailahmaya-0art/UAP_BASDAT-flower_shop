<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "flower_shop"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil";

?>