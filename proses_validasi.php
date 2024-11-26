<?php
// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'rental_mobil');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_sewa = $_POST['id_sewa'];
$id_kendaraan = $_POST['id_kendaraan'];
$tgl_kembali = $_POST['tgl_kembali'];
$denda = $_POST['denda'];
$kondisi = $_POST['kondisi'];

// Insert data pengembalian
$sql = "INSERT INTO pengembalian (id_sewa, id_kendaraan, tgl_kembali, denda, kondisi) 
        VALUES ('$id_sewa', '$id_kendaraan', '$tgl_kembali', '$denda', '$kondisi')";

if ($conn->query($sql) === TRUE) {
    // Update status kendaraan menjadi Tersedia
    $updateStatus = "UPDATE kendaraan SET status = 'Tersedia' WHERE id_kendaraan = '$id_kendaraan'";
    if ($conn->query($updateStatus) === TRUE) {
        echo "Pengembalian berhasil divalidasi dan status kendaraan diperbarui.";
    } else {
        echo "Gagal memperbarui status kendaraan.";
    }
} else {
    echo "Gagal menyimpan data pengembalian: " . $conn->error;
}

$conn->close();
?>
