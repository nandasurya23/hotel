<?php
include('koneksi.php');

// ambil data dari URL
$booking_id = $_GET['booking_id'];

// hapus data dari database
$query = mysqli_query($conn, "DELETE FROM booking WHERE booking_id='$booking_id'");

if ($query) {
  // jika berhasil
  echo "<script>
  alert('Berhasil Menghapus data')
  </script>";
  header('location: booking.php');
} else {
  // jika gagal
  echo "Gagal menghapus data";
}
