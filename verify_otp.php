<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];
    $correct_otp = $_SESSION['otp']; // The OTP we generated earlier

    // Check if the OTP entered is correct
    if ($entered_otp == $correct_otp) {
        echo "OTP Verified Successfully!";
        // Redirect to place order page
        echo '<form method="POST" action="place_order.php">
                  <input type="hidden" name="item" value="' . $_POST['item'] . '">
                  <input type="hidden" name="quantity" value="' . $_POST['quantity'] . '">
                  <input type="hidden" name="total" value="' . $_POST['total'] . '">
                  <input type="hidden" name="phone" value="' . $_POST['phone'] . '">
                  <label>Enter Address:</label>
                  <input type="text" name="address" required><br>
                  <input type="submit" value="Place Order">
              </form>';
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>
