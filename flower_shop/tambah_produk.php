<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_bunga'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['id_kategori'];

    mysqli_query($conn,
    "INSERT INTO produk_bunga (nama_bunga, harga, stok, id_kategori)
    VALUES ('$nama', '$harga', '$stok', '$kategori')");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>

<body>

<div class="menu">
<a href="dashboard.php">Dashboard</a> |
<a href="index.php">Produk</a> |
<a href="pelanggan.php">Pelanggan</a> |
<a href="pesanan.php">Pesanan</a> |
<a href="detail_pesanan.php">Detail Pesanan</a> |
<a href="pembayaran.php">Pembayaran</a>
</div>

<hr>

<h2>Tambah Produk Bunga</h2>

<form method="POST">

Nama Bunga <br>
<input type="text" name="nama_bunga" required><br><br>

Harga <br>
<input type="number" name="harga" required><br><br>

Stok <br>
<input type="number" name="stok" required><br><br>

Kategori <br>
<select name="id_kategori" required>
    <option value="1">Bouquet</option>
    <option value="2">Bunga Meja</option>
    <option value="3">Bunga Wisuda</option>
</select>

<br><br>

<button type="submit" name="simpan">Simpan</button>

</form>

</body>
</html>