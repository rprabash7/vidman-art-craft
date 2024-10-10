<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;
}
?>
<html>
<head><title>Your Cart</title></head>
<body>
    <h2>Your Cart</h2>
    <p>Item: <?php echo $item; ?></p>
    <p>Quantity: <?php echo $quantity; ?></p>
    <p>Total Price: <?php echo $total; ?> Rupees</p>

    <form method="POST" action="order.php">
        <input type="hidden" name="item" value="<?php echo $item; ?>">
        <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <label>Phone Number:</label><br>
        <input type="text" name="phone" required><br>
        <input type="submit" value="Proceed to Checkout">
    </form>
</body>
</html>
