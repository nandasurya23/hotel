<form action="update_payment_process.php" method="post">
  <label for="booking_id">Booking ID:</label><br>
  <input type="text" id="booking_id" name="booking_id" required><br>
  <label for="payment_status">Payment Status:</label><br>
  <select id="payment_status" name="payment_status" required>
    <option value="Belum Bayar">Belum Bayar</option>
    <option value="Sudah Bayar">Sudah Bayar</option>
  </select><br><br>
  <input type="submit" value="Update">
</form> 
