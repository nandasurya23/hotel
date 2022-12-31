<!-- Koneksi Ke database -->

<?php

// Pasangkan detail koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_hotel";

// Buat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Periksa koneksi, tampilkan pesan error jika gagal
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>