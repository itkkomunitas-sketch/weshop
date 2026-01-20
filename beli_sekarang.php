<?php

include_once("function/koneksi.php");
include_once("function/helper.php");

session_start();

$barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;
if(!$barang_id){
    header("location:".BASE_URL);
    exit;
}

$query = mysqli_query($koneksi, "SELECT nama_barang, gambar, harga FROM barang WHERE barang_id='$barang_id' AND status='on'");
if(mysqli_num_rows($query) == 0){
    header("location:".BASE_URL);
    exit;
}

$row = mysqli_fetch_assoc($query);

// set keranjang to only this product
$_SESSION['keranjang'] = array();
$_SESSION['keranjang'][$barang_id] = array(
    'nama_barang' => $row['nama_barang'],
    'gambar' => $row['gambar'],
    'harga' => $row['harga'],
    'quantity' => 1
);

// redirect to checkout data page
header("location:".BASE_URL."index.php?page=data_pemesan");

?>
