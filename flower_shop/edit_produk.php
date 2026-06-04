<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM produk_bunga
WHERE id_bunga='$id'");

$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama = $_POST['nama_bunga'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['id_kategori'];

    mysqli_query($conn,
    "UPDATE produk_bunga
    SET
    nama_bunga='$nama',
    harga='$harga',
    stok='$stok',
    id_kategori='$kategori'
    WHERE id_bunga='$id'");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
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

<h2>Edit Produk</h2>

<form method="POST">

Nama Bunga <br>
<input type="text"
name="nama_bunga"
value="<?= $data['nama_bunga']; ?>"
required>

<br><br>

Harga <br>
<input type="number"
name="harga"
value="<?= $data['harga']; ?>"
required>

<br><br>

Stok <br>
<input type="number"
name="stok"
value="<?= $data['stok']; ?>"
required>

<br><br>

Kategori <br>

<select name="id_kategori">

<option value="1" <?= ($data['id_kategori']==1)?'selected':'' ?>>
Bouquet
</option>

<option value="2" <?= ($data['id_kategori']==2)?'selected':'' ?>>
Bunga Meja
</option>

<option value="3" <?= ($data['id_kategori']==3)?'selected':'' ?>>
Bunga Wisuda
</option>

</select>

<br><br>

<button type="submit" name="update">
Update Produk
</button>

</form>

</body>
</html>