<?php 
// koneksi database
include 'latihan.php';
 
// menangkap data yang di kirim dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
// menginput data ke database
mysqli_query($koneksi, "INSERT INTO user VALUES (NULL, '$nama', '$username', '$password', '$role')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampil.php");
 
?>