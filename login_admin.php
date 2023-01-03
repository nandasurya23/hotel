<?php
  // Koneksi ke database
    include 'koneksi.php';

  // Menangkap data dari form login
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Mengecek apakah data yang dimasukkan sesuai dengan data di database
  $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  // Jika data yang dimasukkan sesuai, arahkan ke halaman dashboard
  if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['admin'] = true;
    header('Location: dashboard.php');
  } else {
    // Jika data yang dimasukkan tidak sesuai, tampilkan pesan error
    echo 'Username atau password salah';
  }
?>
