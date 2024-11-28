<?php
session_start();
include('db.php');  // Include database connection

// Fetch ads from the database
$sql = "SELECT * FROM ads ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!-- HTML for displaying ads -->
<h1>Welcome to the Ads Homepage</h1>

<div class="ads-grid">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Fetch ad and seller details
            $ad_id = $row['id'];
            $seller_id = $row['seller_id'];  // Assuming you have a seller_id in your ads table
            
            echo "<div class='ad'>";
            echo "<img src='uploads/" . $row['image'] . "' alt='Ad Image'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Category: " . $row['category'] . "</p>";

            // Updated button with link to contact seller page
            echo "<a href='contact_seller.php?ad_id=" . $ad_id . "&seller_id=" . $seller_id . "'><button>Contact Seller</button></a>";

            echo "</div>";
        }
    } else {
        echo "<p>No ads available.</p>";
    }
    ?>
</div>

<!-- Link to post an ad -->
<a href="post_ad.php">Post a New Ad</a>
