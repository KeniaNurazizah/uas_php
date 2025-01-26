<?php
// Mulai sesi untuk mengakses data sesi
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Hapus cookie (jika ada)
setcookie("user_email", "", time() - 3600, "/"); // Menghapus cookie dengan mengatur waktu kedaluwarsa ke waktu yang sudah lewat

// Arahkan pengguna kembali ke halaman login setelah logout
header("Location: login.php");
exit; // Pastikan tidak ada kode lain yang dieksekusi setelah pengalihan
?>
