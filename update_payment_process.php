<?php
  // Koneksikan ke database
  include'koneksi.php';
 
  // Ambil data dari form
  $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
  $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
 
  // Buat query update
  $query = "UPDATE booking SET payment_status = '$payment_status' WHERE booking_id = $booking_id";
 
  // Jalankan query
  if (mysqli_query($conn, $query)) {
    echo "Update payment status berhasil.";
    header('Location: booking.php');
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
 
  // Tutup koneksi
  mysqli_close($conn);
?>
