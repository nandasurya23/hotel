<?php
include('koneksi.php');

// ambil data dari URL
$id = $_GET['id'];

// hapus data dari database
$query = mysqli_query($conn, "DELETE FROM users WHERE id='$id'");

if ($query) {
  // jika berhasil
  echo "<script>
  alert('Berhasil Menghapus data')
  </script>";
  header('location: user.php');
} else {
  // jika gagal
  echo "Gagal menghapus data";
}
