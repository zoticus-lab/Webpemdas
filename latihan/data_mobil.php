<?php
session_start();
include 'latihan.php';

// Mengecek apakah pengguna sudah login sebagai user
if (!isset($_SESSION['username']) || $_SESSION['status'] != "login") {
    header("location:form_login.php");
    exit;
}

// Mengambil data mobil dan nama cabang dari database dengan JOIN
$query = "
    SELECT kendaraan.nama, kendaraan.no_plat, kendaraan.tipe_kendaraan, cabang.nama_cabang, kendaraan.harga_sewa, kendaraan.status
    FROM kendaraan
    JOIN cabang ON kendaraan.id_cabang = cabang.id_cabang";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil - Rental Mobil</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');
        body {
            background: linear-gradient(90deg, #dfe9f3 0%, #ffffff 100%);
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: start;
            min-height: 100vh;
        }
        .table-container {
            width: 100%;
            max-width: 1200px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .table-title {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
        }
        thead th {
            background-color: #5f9ea0;
            color: #fff;
            font-weight: 600;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e0f7fa;
        }
        .status {
            padding: 8px 12px;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            display: inline-block;
        }
        .status-tersedia {
            background-color: #4caf50; /* Hijau */
        }
        .status-dibooking {
            background-color: #f44336; /* Merah */
        }
    </style>
</head>
<body>

<div class="table-container">
    <h1 class="table-title">Data Mobil</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nomor Plat</th>
                <th>Jenis Kendaraan</th>
                <th>Cabang</th>
                <th>Harga Sewa</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['no_plat']; ?></td>
                    <td><?php echo $row['tipe_kendaraan']; ?></td>
                    <td><?php echo $row['nama_cabang']; ?></td> <!-- Menampilkan nama cabang -->
                    <td>Rp <?php echo number_format($row['harga_sewa'], 0, ',', '.'); ?></td>
                    <td>
                        <span class="status <?php echo $row['status'] == 'tersedia' ? 'status-tersedia' : 'status-dibooking'; ?>">
                            <?php echo $row['status'] == 'tersedia' ? 'Tersedia' : 'Dibooking'; ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
