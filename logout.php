<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi
header("Location: formlogin.php"); // Mengarahkan kembali ke halaman login
exit;
?>
