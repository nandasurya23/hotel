<?php
include 'koneksi.php';
?>

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
    <title>Dashboard Admin</title>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div class="wrapper">
            <div class="container-nav">
                <h1 class="logo-nav">Welcome Admin</h1>
                <ul class="nav-items">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="user.php">Pengguna</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="room.php">Kamar</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Table -->
    <div class="dashboard">
        <table class="dashboard">
            <tr>
                <th>ID Booking</th>
                <th>Nama</th>
                <th>Jenis Kamar</th>
                <th>Tanggal Check-in</th>
                <th>Tanggal Check-out</th>
                <th>Status Pembayaran</th>
                <th>Create_At</th>
                <th>Aksi</th>
            </tr>
            <?php
            // ambil data dari database
            $query = mysqli_query($conn, "SELECT * FROM booking");

            // looping data untuk menampilkan di tabel
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $data['booking_id'] . "</td>";
                echo "<td>" . $data['name'] . "</td>";
                echo "<td>" . $data['room_type'] . "</td>";
                echo "<td>" . $data['check_in_date'] . "</td>";
                echo "<td>" . $data['check_out_date'] . "</td>";
                echo "<td>" . $data['payment_status'] . "</td>";
                echo "<td>" . $data['created_at'] . "</td>";
                echo "<td>
                  <a href='update_payment.php?booking_id=" . $data['booking_id'] . "'>Update</a>
                  <a href='delete_booking.php?booking_id=" . $data['booking_id'] . "'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>



</body>

</html>