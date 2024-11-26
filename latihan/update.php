<?php
include 'latihan.php';

$iduser = $_POST['iduser'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$query = "UPDATE user SET nama='$nama', username='$username', password='$password', roler='$role' WHERE id_User='$iduser'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: tampil.php");
} else {
    echo "Data gagal diupdate!";
}
?>
