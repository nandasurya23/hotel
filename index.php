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
    <title>Hotel Jaya</title>
</head>


<body>
    <!-- Navigasi Menu -->
    <nav>
        <div class="wrapper">
            <div class="container-nav">
                <h1 class="logo-nav"><a href="#home">Hotel Jaya</a></h1>
                <ul class="nav-items">
                    <li><a href="#book">Check-in/Out</a></li>
                    <li><a href="#room">Kamar</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
                <?php
                session_start();

                if (isset($_SESSION['username'])) {
                    // Jika user sudah login, tampilkan alert session username
                    echo "<script>alert('Selamat Datang Di Website Hotel Jaya, " . $_SESSION['username'] . "')</script>";
                    // Tampilkan tombol logout
                    echo "<div class='btn'><button><a href='?logout'>Logout</a></button></div>";
                } else {
                    // Jika user belum login, tampilkan tombol login
                    echo "<div class='btn'><button><a href='login.php'>Login</a></button></div>";
                }

                if (isset($_GET['logout'])) {
                    // Hapus session username
                    unset($_SESSION['username']);
                    // Kembali ke halaman index
                    header("Location: index.php");
                    exit;
                }
                ?>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <div class="hero" id="home">
        <div class="wrapper">
            <div class="hero-container">
                <img src="img/ilustrator-hero.png" alt="Ilustrator">
                <div class="desc-hero">
                    <h2>Selamat Datang Di Hotel Jaya</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Nihil commodi vel quas consequuntur quo deserunt molestias perspiciatis,
                        sequi dolor dolorem aspernatur facilis hic fugit tempore voluptatum maxime dolores explicabo cumque?
                    </p>
                    <div class="btn btn-hero">
                        <button><a href="register.php">Register</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service & Facilitas Section -->
    <div class="service">
        <div class="wrapper">
            <div class="service-container">
                <div class="service-detail">
                    <h3>Jangkauan Wifi Luas</h3>
                    <span class="material-symbols-outlined">router</span>
                </div>
                <div class="service-detail">
                    <h3>Laundry Service</h3>
                    <span class="material-symbols-outlined">local_laundry_service</span>
                </div>
                <div class="service-detail">
                    <h3>HouseKeeping Service</h3>
                    <span class="material-symbols-outlined">king_bed</span>
                </div>
                <div class="service-detail">
                    <h3>Pelayanan Cepat</h3>
                    <span class="material-symbols-outlined">speed</span>
                </div>
            </div>
        </div>
    </div>
    <!-- booking -->
    <div class="booking" id="book">
        <div class="wrapper">
            <?php

            // mulai sesi
            session_start();

            // cek apakah user sudah login atau belum
            if (!isset($_SESSION['username'])) {
                // jika belum login, tampilkan pesan dan form booking hanya untuk informasi saja
                $is_logged_in = false;
            } else {
                $is_logged_in = true;
            }
            // koneksi ke database
            include 'koneksi.php';

            // menangkap data yang dikirim dari form
            $name = $_POST['name'];
            $room_type = $_POST['room_type'];
            $check_in_date = $_POST['check_in_date'];
            $check_out_date = $_POST['check_out_date'];

            // mengecek apakah tanggal check-in sama dengan tanggal check-out
            if ($check_in_date == $check_out_date) {
                echo "<p style='text-align:center;'>Isi Form Dengan Lengkap</p>";
            } else {
                // mengecek apakah tanggal check-in lebih besar dari tanggal check-out
                if ($check_in_date > $check_out_date) {
                    echo "Tanggal check-in tidak boleh lebih besar dari tanggal check-out.";
                } else {
                    // mengecek ketersediaan kamar
                    $result = mysqli_query($conn, "SELECT * FROM room WHERE room_type = '$room_type' AND availability = 'available'");
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                        // jika kamar tersedia, melakukan pemesanan'

                        $query = "INSERT INTO booking (name, room_type, check_in_date, check_out_date) VALUES ('$name', '$room_type', '$check_in_date', '$check_out_date')";
                        mysqli_query($conn, $query);

                        // mengupdate ketersediaan kamar menjadi 'not available'
                        $query = "UPDATE room SET availability = 'not available' WHERE room_type = '$room_type'";
                        mysqli_query($conn, $query);

                        // menampilkan pesan sukses
                        echo "Booking berhasil dilakukan!";
                    } else {
                        // jika kamar tidak tersedia, menampilkan pesan gagal
                        echo "Maaf, kamar tidak tersedia pada tanggal yang dipilih.";
                    }
                    // mengambil ID pemesanan terbaru
                    $query = "SELECT booking_id FROM booking ORDER BY booking_id DESC LIMIT 1";
                    $result = mysqli_query($conn, $query);
                    $booking = mysqli_fetch_assoc($result);
                    $booking_id = $booking['booking_id'];

                    // mengambil nomor WhatsApp dari database
                    $query = "SELECT phone_number FROM contact WHERE channel = 'WhatsApp'";
                    $result = mysqli_query($conn, $query);
                    $contact = mysqli_fetch_assoc($result);
                    $phone_number = $contact['phone_number'];

                    // mengarahkan user ke aplikasi WhatsApp
                    header("Location: https://api.whatsapp.com/send?phone=$phone_number&text=Halo%20saya%20ingin%20melakukan%20pembayaran%20untuk%20booking%20nomor%20$booking_id");
                }
            }
            ?>
            <p style="margin-bottom: 20px; margin-top:5px; font-size:14px; text-align:center;">
                Anda Akan Di Arahakan Otomatis Ke WhatsApp Admin Hotel Jaya untuk Melakukan Pembayaran <br>
                Jika Sudah Mengisi Form Booking.
            </p>
            <div class="booking-container">
                <form method="post" <?php if (!$is_logged_in) echo "disabled"; ?>>
                    <label for="Name">Nama</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Masukan Nama Anda..." required>
                    <label for="Type Room">Tipe Kamar</label>
                    <select name="room_type" required>
                        <?php
                        // koneksi ke database
                        include 'koneksi.php';

                        // menampilkan jenis kamar yang tersedia
                        $result = mysqli_query($conn, "SELECT room_type, price FROM room WHERE availability = 'available'");
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['room_type'] . "'>" . $row['room_type'] . " (Rp " . $row['price'] . ")</option>";
                        }
                        ?>
                    </select>
                    <label for="Check-in">Check In</label>
                    <input type="date" name="check_in_date" value="<?php echo $check_in_date; ?>" required>
                    <label for="Check-in">Check Out</label>
                    <input type="date" name="check_out_date" value="<?php echo $check_in_date; ?>" required>
                    <input type="submit" value="Booking" formtarget="_blank" <?php if (!$is_logged_in) echo "disabled"; ?>>
                    <!-- pesan jika belum login -->
                    <?php if (!$is_logged_in) : ?>
                        <br>
                        <p>Anda harus <a style="color: #fff;" href="login.php">login</a> terlebih dahulu untuk melakukan booking.</p>
                        <br>
                        <p>Jika Belum Memiliki Akun Anda Bisa <a style="color: #fff;" href="register.php">Register</a> terlebih dahulu</p>
                    <?php endif; ?>
                </form>
                <img src="img/booking-ilustrator.png" alt="booking">
            </div>
        </div>
    </div>
    <!-- Rooms Section -->
    <div class="room" id="room">
        <div class="wrapper">
            <div class="container-room">
                <div class="card-room">
                    <img src="img/standar.jpg" alt="" class="card-img" style="height: 59%;">
                    <div class="card-desc">
                        <h3>Kamar Standar</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, labore.</p>
                        <span>Rp 300.000</span>
                    </div>
                </div>
                <div class="card-room">
                    <img src="img/VIP.jpg" alt="" class="card-img">
                    <div class="card-desc">
                        <h3>Kamar VIP</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, labore.</p>
                        <span>Rp 800.000</span>
                    </div>
                </div>
                <div class="card-room">
                    <img src="img/VVIP.jpg" alt="" class="card-img">
                    <div class="card-desc">
                        <h3>Kamar VVIP</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, labore.</p>
                        <span>Rp 1.300.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section -->
    <div class="about" id="about">
        <div class="wrapper">
            <div class="desc-about">
                <h2>About Hotel Jaya</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque,
                    laboriosam. Hic vitae harum adipisci,
                    minima similique repudiandae nobis veritatis doloremque optio molestias aspernatur possimus sunt placeat voluptatibus,
                    sapiente odio animi.
                </p>
                <img src="img/about.jpg" alt="" class="img-about">
            </div>
        </div>
    </div>
    <!-- Contact US -->
    <div class="contact" id="contact">
        <div class="wrapper">
            <h1 class="">Kontak Kami</h1>
            <div class="contact-desc">
                <a href="mailto:HotelJaya@gmail.com" target="_blank">Email : HotelJaya@gmail.com</a>
                <a href="https://wa.me/087453678921" target="_blank">WhatsApp : 087453678921</a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <h1>Copyright 2022 Hotel Jaya</h1>
    </footer>
</body>

</html>