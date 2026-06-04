<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";

$query = mysqli_query($conn,
"SELECT
detail_pesanan.id_detail,
detail_pesanan.id_pesanan,
produk_bunga.nama_bunga,
detail_pesanan.jumlah_pesanan,
detail_pesanan.subtotal
FROM detail_pesanan
INNER JOIN produk_bunga
ON detail_pesanan.id_bunga = produk_bunga.id_bunga");

if (!$query) {
    die(mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>

    <style>
    body{
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #fff5f8;
    }

    .menu{
        background-color: #ffb6c1;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .menu a{
        text-decoration: none;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    .menu a:hover{
        color: #ffe4ec;
    }

    table{
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    th{
        background-color: #ffb6c1;
        color: white;
    }

    th, td{
        border: 1px solid #ffd6df;
        padding: 10px;
        text-align: center;
    }

    h2{
        color: #d63384;
    }

    .btn-tambah{
        background-color: #ff69b4;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .btn-edit{
        color: #ff1493;
    }

    .btn-hapus{
        color: red;
    }
    </style>
</head>

<body>

<div class="menu">
<a href="dashboard.php">Dashboard</a> |
<a href="index.php">Produk</a> |
<a href="pelanggan.php">Pelanggan</a> |
<a href="pesanan.php">Pesanan</a> |
<a href="detail_pesanan.php">Detail Pesanan</a> |
<a href="pembayaran.php">Pembayaran</a> |
<a href="logout.php">Logout</a>
</div>

<h2> Detail Pesanan </h2>

<table>
    <tr>
        <th>ID Detail</th>
        <th>ID Pesanan</th>
        <th>Nama Bunga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>

    <?php while($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id_detail']; ?></td>
        <td><?= $data['id_pesanan']; ?></td>
        <td><?= $data['nama_bunga']; ?></td>
        <td><?= $data['jumlah_pesanan']; ?></td>
        <td>Rp <?= number_format($data['subtotal']); ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>