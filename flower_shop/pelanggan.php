<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>

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

<h2> Data Pelanggan </h2>

<a href="tambah_pelanggan.php" class="btn-tambah">
+ Tambah Pelanggan
</a>

<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Pelanggan</th>
        <th>Nomor HP</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    <?php while($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id_pelanggan']; ?></td>
        <td><?= $data['nama_pelanggan']; ?></td>
        <td><?= $data['nomor_hp']; ?></td>
        <td><?= $data['alamat']; ?></td>
        <td><?= $data['email']; ?></td>

        <td>
            <a class="btn-edit"
            href="edit_pelanggan.php?id=<?= $data['id_pelanggan']; ?>">
            Edit
            </a>

            |

            <a class="btn-hapus"
            href="hapus_pelanggan.php?id=<?= $data['id_pelanggan']; ?>"
            onclick="return confirm('Yakin ingin menghapus pelanggan?')">
            Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>