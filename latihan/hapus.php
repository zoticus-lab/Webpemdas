<?php 
// koneksi database
include 'latihan.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from user where id_User='$id'");

 
// mengalihkan halaman kembali ke index.php
header("location:tampil.php");
 
?>