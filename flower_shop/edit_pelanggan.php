<?php
include "koneksi.php";

$id=$_GET['id'];

$data=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM pelanggan
WHERE id_pelanggan='$id'")
);

if(isset($_POST['update'])){

$nama=$_POST['nama'];
$hp=$_POST['hp'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];

mysqli_query($conn,
"UPDATE pelanggan
SET
nama_pelanggan='$nama',
nomor_hp='$hp',
alamat='$alamat',
email='$email'
WHERE id_pelanggan='$id'");

header("Location: pelanggan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pelanggan</title>
</head>
<body>

<h2>Edit Pelanggan</h2>

<form method="POST">

Nama<br>
<input type="text"
name="nama"
value="<?= $data['nama_pelanggan']; ?>">

<br><br>

No HP<br>
<input type="text"
name="hp"
value="<?= $data['nomor_hp']; ?>">

<br><br>

Alamat<br>
<input type="text"
name="alamat"
value="<?= $data['alamat']; ?>">

<br><br>

Email<br>
<input type="email"
name="email"
value="<?= $data['email']; ?>">

<br><br>

<button type="submit" name="update">
Update
</button>

</form>

</body>
</html>