<?php
session_start();
include('db.php');  // Include database connection

// Check if form is submitted and user is logged in
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Check if the file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Get the uploaded file's name and temporary path
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // Define the target directory and file path
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image); // Prevent overwriting with basename()

        // Check if the directory exists, and create it if not
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Insert ad data into the database
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO ads (user_id, title, description, price, image, category) 
                    VALUES ('$user_id', '$title', '$description', '$price', '$image', '$category')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Ad posted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No image file uploaded or there was an error with the file.";
    }
}
?>

<!-- HTML form for posting an ad -->
<form action="post_ad.php" method="POST" enctype="multipart/form-data">
    <label for="title">Ad Title</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="description">Description</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="price">Price</label><br>
    <input type="number" id="price" name="price" required><br><br>

    <label for="category">Category</label><br>
    <select id="category" name="category" required>
        <option value="Electronics">Electronics</option>
        <option value="Vehicles">Vehicles</option>
        <option value="Furniture">Furniture</option>
        <!-- Add more categories as needed -->
    </select><br><br>

    <label for="image">Image</label><br>
    <input type="file" id="image" name="image" required><br><br>

    <input type="submit" value="Post Ad">
</form>
