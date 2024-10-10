<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert into orders table
    $sql = "INSERT INTO orders (item_name, quantity, total, phone, address) 
            VALUES ('$item', $quantity, $total, '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Order Confirmed!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<html>
<head><title>Order Processed</title></head>
<body>
    <h2>Order Successful!</h2>
    <p>Your order has been confirmed.</p>
    <p><a href="index.php">Go Back to Home</a></p>
</body>
</html>
