<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phone'])) {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
    $phone = $_POST['phone'];

    // Generate a random 6-digit OTP
    $_SESSION['otp'] = rand(100000, 999999);

    // Simulate OTP being sent (in real-world, this would be sent via SMS)
    echo "OTP sent to your phone: " . $_SESSION['otp']; // Display OTP for testing purposes.
}
?>
<html>
<head><title>OTP Verification</title></head>
<body>
    <h2>OTP Verification</h2>
    <form method="POST" action="verify_otp.php">
        <label>Enter OTP:</label>
        <input type="text" name="otp" required><br>
        <input type="hidden" name="item" value="<?php echo $item; ?>">
        <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
        <input type="submit" value="Verify OTP">
    </form>
</body>
</html>
