<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(90deg, #dfe9f3 0%, #ffffff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #5f9ea0;
            color: white;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-secondary {
            background-color: #5f9ea0;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #4682b4;
        }
        .btn-success {
            border-radius: 50px;
            background-color: #5f9ea0;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #4682b4;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update Data User</h4>
                </div>
                <div class="card-body">
                    <a href="tampil.php" class="btn btn-secondary mb-3">Kembali</a>

                    <?php
                    include 'latihan.php';
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE id_User='$id'");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <form method="post" action="update.php">
                        <input type="hidden" name="iduser" value="<?php echo $d['id_User']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $d['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $d['password']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $d['role']; ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </form>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
