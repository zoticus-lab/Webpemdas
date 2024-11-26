<?php 
session_start();
include 'latihan.php';

// Menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Menyeleksi data pada tabel user dengan username dan password yang sesuai
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$data = mysqli_query($koneksi, $query);

// Cek jika query berhasil
if (!$data) {
    die("Query failed: " . mysqli_error($koneksi));
}

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $row = mysqli_fetch_assoc($data);

    if (isset($row['id_user'])) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        $_SESSION['id_user'] = $row['id_user']; // Simpan id_user di sesi

        // Mendapatkan alamat IP dan user agent
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        // Menyimpan log login ke tabel log_logon
        $id_user = $row['id_user'];
        $log_query = "INSERT INTO log_logon (id_user, ip_address, user_agent) VALUES ('$id_user', '$ip_address', '$user_agent')";
        mysqli_query($koneksi, $log_query);

        // Redirect sesuai role
        $role = $row['role'];
        if ($role == 'admin') {
            header("location:tampil.php");
        } elseif ($role == 'pemilik') {
            header("location:dashboard_pemilik.php");
        } elseif ($role == 'customer') {
            header("location:dashboard_user.php");
        } else {
            echo "<script>alert('Role tidak dikenali!');</script>";
            echo "<script>window.location ='formlogin.php';</script>";
        }
        exit;
    } else {
        echo "ID User tidak ditemukan dalam database.";
    }
} else {
    echo "Username atau password salah!";
}
?>
