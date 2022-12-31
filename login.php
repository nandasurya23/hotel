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
    <title>Login Page</title>
</head>

<?php 
 
include 'koneksi.php';
 
error_reporting(0);
//  Melakukan Session Start
session_start();
//  Check session Username
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
//  Check Data dari Database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>
 


<body>
    <!-- Login Page -->
    <div class="login">
        <form action="" method="post" class="login">
            <h1>Login</h1>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Masukan Username Anda..." required>
            <label for="password">password</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" placeholder="Masukan Password Anda..." required>
            <div class="login-btn-container">
                <input type="submit" name="submit" value="login">
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>

</body>

</html>