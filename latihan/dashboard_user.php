<?php
session_start();
include 'latihan.php';

// Mengecek apakah pengguna sudah login sebagai user
if (!isset($_SESSION['username']) || $_SESSION['status'] != "login") {
    header("location:form_login.php");
    exit;
}

// Mengambil data mobil dari database
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rental Mobil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="dashboard">
    <div class="header">
        <h1>Dashboard Peminjaman Mobil</h1>
        <button class="logout-btn" onclick="window.location.href='formlogin.php'">Logout</button>
    </div>
    <div class="content">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <h2><?php echo $row['nama']; ?></h2>
                <p>Nomor Plat: <?php echo $row['no_plat']; ?></p>
                <p>Harga per hari: Rp <?php echo $row['harga_sewa']; ?></p>
                <p>Jenis Mobil: <?php echo $row['tipe_kendaraan']; ?></p>
                <p>Status: <?php echo isset($row['status']) && $row['status'] == 'Tersedia' ? 'Tersedia' : 'Dibooking'; ?></p>
                <?php if (isset($row['status']) && $row['status'] == 'Tersedia') { ?>
                    <!-- Menyertakan id_cabang dan id_kendaraan dalam URL -->
                    <button class="button" onclick="window.location.href='booking.php?id_kendaraan=<?php echo $row['id_kendaraan']; ?>&id_cabang=<?php echo $row['id_cabang']; ?>'">Booking</button>
                <?php } else { ?>
                    <button class="button" disabled>Sudah Dibooking</button>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
