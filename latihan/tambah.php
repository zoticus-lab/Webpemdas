<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
          crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            max-width: 500px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #5f9ea0;
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            font-size: 1.1em;
        }

        .form-control:focus {
            border-color: #5f9ea0;
            box-shadow: 0 0 5px rgba(95, 158, 160, 0.5);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #5f9ea0;
            color: #fff;
            border-radius: 50px;
            padding: 10px 20px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #4682b4;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>TAMBAH DATA Pengguna</h3>
        <form method="POST" action="inputuser.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input class="form-control form-control-lg" type="text" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control form-control-lg" type="text" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control form-control-lg" type="password" id="password" name="password" required>
            </div>
            <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-control form-control-lg" id="role" name="role" required>
        <option value="">Pilih Role</option>
        <option value="admin">Admin</option>
        <option value="customer">Customer</option>
        <option value="pemilik">Pemilik</option>
    </select>
</div>
            <div class="button-group">
                <button type="button" onclick="location.href='tampil.php'" class="btn btn-custom">Tampil</button>
                <button type="submit" class="btn btn-custom">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>
