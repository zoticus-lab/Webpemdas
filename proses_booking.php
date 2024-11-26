<?php
session_start();
include 'latihan.php';

// Pastikan id_user tersedia dalam sesi
if (!isset($_SESSION['id_user'])) {
    echo "<script>
            alert('ID user tidak ditemukan. Silakan login ulang.');
            window.location.href = 'formlogin.php';
          </script>";
    exit;
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Ambil data dari form booking
$tgl_pinjam = $_POST['tgl_pinjam'] ?? null;
$tgl_kembali = $_POST['tgl_kembali'] ?? null;
$id_cabang = $_POST['id_cabang'] ?? null;
$id_kendaraan = $_POST['id_kendaraan'] ?? null;

// Periksa apakah semua data form telah terisi
if ($tgl_pinjam && $tgl_kembali && $id_cabang && $id_kendaraan) {
    // Query untuk menyimpan data booking ke tabel penyewaan
    $query = "INSERT INTO penyewaan (tgl_kembali, tgl_pinjam, id_cabang, id_kendaraan, id_user) 
              VALUES ('$tgl_kembali', '$tgl_pinjam', '$id_cabang', '$id_kendaraan', '$id_user')";

    // Jalankan query insert dan periksa apakah berhasil
    if (mysqli_query($koneksi, $query)) {
        // Jika booking berhasil, update status kendaraan menjadi 'Dibooking'
        $updateStatusQuery = "UPDATE kendaraan SET status = 'Dibooking' WHERE id_kendaraan = $id_kendaraan";
        if (mysqli_query($koneksi, $updateStatusQuery)) {
            echo "<script>
                    alert('Booking berhasil! Kendaraan telah dibooking.');
                    window.location.href = 'dashboard_user.php';
                  </script>";
        } else {
            echo "Error updating vehicle status: " . mysqli_error($koneksi);
        }
    } else {
        // Tampilkan error jika query insert gagal
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Tampilkan pesan error jika data tidak lengkap
    echo "<script>
            alert('Data booking tidak lengkap. Silakan lengkapi semua informasi.');
            window.location.href = 'form_booking.php';
          </script>";
}
?>
