<?php
session_start();
include 'latihan.php';

// Mengecek apakah pengguna sudah login sebagai user
if (!isset($_SESSION['username']) || $_SESSION['status'] != "login") {
    header("location:formlogin.php");
    exit;
}

// Pastikan id_kendaraan dan id_cabang tersedia di URL
if (!isset($_GET['id_kendaraan']) || !isset($_GET['id_cabang'])) {
    echo "Data kendaraan tidak ditemukan.";
    exit;
}

$id_kendaraan = $_GET['id_kendaraan'];
$id_cabang = $_GET['id_cabang'];

// Mengambil detail kendaraan yang dipilih dari database
$query = "SELECT * FROM kendaraan WHERE id_kendaraan = $id_kendaraan";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Kendaraan tidak ditemukan.";
    exit;
}

$kendaraan = mysqli_fetch_assoc($result);
$id_user = $_SESSION['id_user']; // Mengambil id_user dari sesi
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking - Rental Mobil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="dashboard">
    <div class="header">
        <h1>Form Booking</h1>
        <button class="logout-btn" onclick="window.location.href='formlogin.php'">Logout</button>
    </div>
    <div class="content">
        <div class="card">
            <h2><?php echo $kendaraan['nama']; ?></h2>
            <p>Nomor Plat: <?php echo $kendaraan['no_plat']; ?></p>
            <p>Harga per hari: Rp <?php echo $kendaraan['harga_sewa']; ?></p>
            <p>Jenis Mobil: <?php echo $kendaraan['tipe_kendaraan']; ?></p>
            <form action="proses_booking.php" method="POST">
                <input type="hidden" name="id_kendaraan" value="<?php echo $id_kendaraan; ?>">
                <input type="hidden" name="id_cabang" value="<?php echo $id_cabang; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                
                <label for="tgl_pinjam">Tanggal Pinjam:</label>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" required><br><br>
                
                <label for="tgl_kembali">Tanggal Kembali:</label>
                <input type="date" id="tgl_kembali" name="tgl_kembali" required><br><br>
                
                <button type="submit" class="button">Konfirmasi Booking</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
