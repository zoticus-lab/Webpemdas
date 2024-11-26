<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit;
}

// Mengatur header untuk mencegah cache
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); // HTTP/1.0
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
          crossorigin="anonymous">
    
    <style>
        body {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            margin-top: 50px;
        }
        .custom-table {
            margin: 20px auto;
            width: 85%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        thead {
            background-color: #5f9ea0;
            color: #fff;
        }
        tr {
            transition: background-color 0.3s;
        }
        tr:hover {
            background-color: #f0f8ff;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
        }
        .btn-custom {
            background-color: #5f9ea0;
            color: #f8f9fa;
            border-radius: 50px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #4682b4;
            color: #ffffff;
        }
        .btn-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logout-container {
            text-align: right;
            margin-top: 20px;
        }
        .btn-logout {
            background-color: #dc3545;
            color: #fff;
            border-radius: 20px;
            padding: 8px 16px;
        }
        .btn-logout:hover {
            background-color: #c82333;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout-container">
            <button type="button" onclick="location.href='logout.php'" class="btn btn-logout">Logout</button>
        </div>
        <div class="btn-container">
            <button type="button" onclick="location.href='tambah.php'" class="btn btn-custom">Tambah Data</button>
        </div>

        <table class="table table-striped table-bordered custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include 'latihan.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM user");
                if (!$data) {
                    die("Query error: " . mysqli_error($koneksi));
                }
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($d['nama']); ?></td>
                        <td><?php echo htmlspecialchars($d['username']); ?></td>
                        <td><?php echo htmlspecialchars($d['password']); ?></td>
                        <td><?php echo htmlspecialchars($d['role']); ?></td>
                        <td>
                            <a role="button" class="btn btn-sm btn-info" href="ubah.php?id=<?php echo $d['id_user']; ?>">Ubah</a>
                            <a role="button" class="btn btn-sm btn-danger" href="hapus.php?id=<?php echo $d['id_user']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Menggunakan JavaScript untuk menghapus halaman sebelumnya dari riwayat
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
