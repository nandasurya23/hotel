<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Register Page</title>
</head>

<?php 
 
include 'koneksi.php';
 
error_reporting(0);
 
session_start();
//  check session username 
if (isset($_SESSION['username'])) {
    header("Location: login.php");
}
//  Post inputan User Ke database
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
//  Menambahkan Data Ke Database
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!'); document.location.href = 'login.php';</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>

<body>
    <!-- Regsiter Page -->
    <div class="register">
        <form action="" method="post">
            <h1>Register</h1>
            <label for="username">username</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Masukan Username Anda..." required>
            <label for="username">email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Masukan email Anda..." required>
            <label for="password">password</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" placeholder="Masukan Password Anda..." required>
            <label for="cpassword">konfirmasi password</label>
            <input type="password" name="cpassword" id="cpassword" value="<?php echo $_POST['cpassword']; ?>" placeholder="Masukan Konfirmasi Password Anda..." required>
            <div class="login-btn-container">
                <input type="submit" name="submit" value="register">
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>

</body>

</html>