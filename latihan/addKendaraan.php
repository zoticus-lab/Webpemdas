<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'rental_mobil');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$no_plat = $_POST['no_plat'];
$tipe_kendaraan = $_POST['tipe_kendaraan'];
$status = $_POST['status'];
$id_cabang = $_POST['id_cabang']; // Ambil ID cabang
$harga_sewa = $_POST['harga_sewa'];

// Query untuk menambahkan data mobil
$sql = "INSERT INTO kendaraan (nama, no_plat, tipe_kendaraan, status, id_cabang, harga_sewa) 
        VALUES ('$nama', '$no_plat', '$tipe_kendaraan', '$status', '$id_cabang', '$harga_sewa')";

if ($conn->query($sql) === TRUE) {
    echo "Data mobil berhasil ditambahkan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
