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
  <title>Admin</title>
</head>

<body>
  <div class="admin">
    <form action="login_admin.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required>
      <input type="submit" value="Login Admin">
    </form>
  </div>


</body>

</html>