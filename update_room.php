<form action="update_room_process.php" method="post">
<label for="availability">Tipe Kamar:</label> <br>
  <input type="text" name="room_type" value="<?php echo $room_type; ?>"> <br>
  <label for="availability">Ketersediaan:</label><br>
  <select name="availability">
    <option value="available" <?php echo ($availability == 'available') ? 'selected' : ''; ?>>Available</option>
    <option value="not available" <?php echo ($availability == 'not available') ? 'selected' : ''; ?>>Not Available</option>
  </select><br>
  <input type="submit" name="submit" value="Update">
</form>