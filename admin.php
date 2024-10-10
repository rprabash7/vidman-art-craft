<?php include 'db.php'; ?>
<html>
<head><title>Admin - Add Items</title></head>
<body>
    <h2>Add Item</h2>
    <!-- This is the form for adding an item -->
    <form method="POST" action="admin.php" enctype="multipart/form-data">
        <label>Item Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br>
        <label>Description:</label><br>
        <textarea name="description" required></textarea><br>
        <label>Image:</label><br>
        <!-- Use file input to allow image upload -->
        <input type="file" name="image" accept="image/*" required><br><br>
        <input type="submit" name="add_item" value="Add Item">
    </form>

    <?php
    // This is the PHP logic to handle the form submission and file upload
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        
        // Handle the image upload
        $target_dir = "images/"; // Folder to store images
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a real image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $upload_ok = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $upload_ok = 0;
        }

        // Limit file size (optional - e.g., 5MB max)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats (e.g., jpg, png, gif)
        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                // Save item details to the database, including the image file path
                $image_path = basename($_FILES["image"]["name"]); // Save only the file name to the database
                $sql = "INSERT INTO items (name, price, description, image) 
                        VALUES ('$name', $price, '$description', '$image_path')";

                if ($conn->query($sql) === TRUE) {
                    echo "Item added successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>
</body>
</html>
