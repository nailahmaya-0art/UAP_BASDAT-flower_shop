<?php

include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM produk_bunga
WHERE id_bunga='$id'");

header("Location: index.php");

?>