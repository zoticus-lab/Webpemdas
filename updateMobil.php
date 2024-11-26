<?php
$conn = new mysqli('localhost', 'root', '', 'rental_mobil');
$no_plat = $_POST['no_plat'];
$nama = $_POST['nama'];
$tipe_kendaraan = $_POST['tipe_kendaraan'];
$status = $_POST['status'];
$harga_sewa = $_POST['harga_sewa'];

$sql = "UPDATE kendaraan SET nama='$nama', tipe_kendaraan='$tipe_kendaraan', status='$status', harga_sewa='$harga_sewa' WHERE no_plat='$no_plat'";

if ($conn->query($sql) === TRUE) {
    echo "Data mobil berhasil diupdate";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
