<?php
// koneksi.php
$conn = new mysqli('localhost', 'root', '', 'rental_mobil');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$no_plat = $_POST['no_plat'];
$tipe_kendaraan = $_POST['tipe_kendaraan'];
$status = $_POST['status'];
$harga_sewa = $_POST['harga_sewa'];
$id_cabang = $_POST['id_cabang'];  // Menambahkan id_cabang

// Query untuk menambahkan data mobil
$sql = "INSERT INTO kendaraan (nama, no_plat, tipe_kendaraan, status, harga_sewa, id_cabang) 
        VALUES ('$nama', '$no_plat', '$tipe_kendaraan', '$status', '$harga_sewa', '$id_cabang')";

if ($conn->query($sql) === TRUE) {
    echo "Data mobil berhasil ditambahkan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
