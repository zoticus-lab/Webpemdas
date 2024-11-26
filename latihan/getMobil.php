<?php
$conn = new mysqli('localhost', 'root', '', 'rental_mobil');
$no_plat = $_GET['no_plat'];
$result = $conn->query("SELECT * FROM kendaraan WHERE no_plat = '$no_plat'");
echo json_encode($result->fetch_assoc());
$conn->close();
?>
