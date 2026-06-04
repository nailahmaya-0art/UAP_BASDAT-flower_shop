<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";

$produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk_bunga"));
$pelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan"));
$pesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesanan"));
$pembayaran = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pembayaran"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Flower Shop</title>

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

    h1{
        color: #d63384;
        text-align: center;
    }

    .card{
        width: 220px;
        display: inline-block;
        background-color: white;
        border: 2px solid #ffb6c1;
        border-radius: 15px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .card h3{
        color: #d63384;
    }

    .jumlah{
        font-size: 35px;
        font-weight: bold;
        color: #ff1493;
    }

    .container{
        text-align: center;
        margin-top: 30px;
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

<h1> Dashboard Flower Shop </h1>

<div class="container">

    <div class="card">
        <h3>Produk</h3>
        <div class="jumlah"><?= $produk ?></div>
    </div>

    <div class="card">
        <h3>Pelanggan</h3>
        <div class="jumlah"><?= $pelanggan ?></div>
    </div>

    <div class="card">
        <h3>Pesanan</h3>
        <div class="jumlah"><?= $pesanan ?></div>
    </div>

    <div class="card">
        <h3>Pembayaran</h3>
        <div class="jumlah"><?= $pembayaran ?></div>
    </div>

</div>

</body>
</html>