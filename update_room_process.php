<?php
  // Koneksikan ke database
  include'koneksi.php';

  // check if form is submitted
if (isset($_POST['submit'])) {
  // get form data
  $room_type = $_POST['room_type'];
  $availability = $_POST['availability'];

  // update room availability in the database
  $query = "UPDATE room SET availability = '$availability' WHERE room_type = '$room_type'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    // update success
    header('Location: room.php');
  } else {
    // update failed
    echo "Update failed: " . mysqli_error($conn);
  }
}
?>
