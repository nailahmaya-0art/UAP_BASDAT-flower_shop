<?php
include "koneksi.php";

if(isset($_POST['simpan'])){

$nama=$_POST['nama'];
$hp=$_POST['hp'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];

mysqli_query($conn,
"INSERT INTO pelanggan
(nama_pelanggan,nomor_hp,alamat,email)
VALUES
('$nama','$hp','$alamat','$email')");

header("Location: pelanggan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Pelanggan</title>
</head>
<body>

<h2>Tambah Pelanggan</h2>

<form method="POST">

Nama<br>
<input type="text" name="nama" required>

<br><br>

No HP<br>
<input type="text" name="hp" required>

<br><br>

Alamat<br>
<input type="text" name="alamat" required>

<br><br>

Email<br>
<input type="email" name="email" required>

<br><br>

<button type="submit" name="simpan">
Simpan
</button>

</form>

</body>
</html>