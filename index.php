<?php include 'db.php'; ?>

<html>
<head><title>Search Items</title></head>
<body>
    <form method="POST" action="">
        <label>Search for Items:</label><br>
        <input type="text" name="search" placeholder="Search items..."><br><br>
        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM items WHERE name LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>Price: " . $row['price'] . " Rupees</p>";
                echo "<p>Description: " . $row['description'] . "</p>";
                // Display image from the folder
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "' width='100'><br>";
                echo "<form method='POST' action='cart.php'>";
                echo "<input type='hidden' name='item' value='" . $row['name'] . "'>";
                echo "<input type='hidden' name='price' value='" . $row['price'] . "'>";
                echo "<label>Quantity:</label>";
                echo "<input type='number' name='quantity' value='1' min='1'><br>";
                echo "<input type='submit' value='Add to Cart'>";
                echo "</form>";
                echo "</div><hr>";
            }
        } else {
            echo "No items found!";
        }
    }
    ?>
</body>
</html>
