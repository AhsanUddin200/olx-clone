<?php
session_start();
include('db.php');  // Include database connection

// Ensure that the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to contact the seller.";
    exit;
}

// Get the ad and seller details from the query string
$ad_id = $_GET['ad_id'];
$seller_id = $_GET['seller_id'];

// Check if seller_id is provided and valid
if (empty($seller_id)) {
    echo "Invalid seller ID.";
    exit;
}

// Fetch the ad details from the database
$sql = "SELECT * FROM ads WHERE id = '$ad_id'";
$result = $conn->query($sql);
$ad = $result->fetch_assoc();

// Check if the ad exists
if (!$ad) {
    echo "Ad not found.";
    exit;
}

// Check if the seller exists in the users table
$sql = "SELECT id FROM users WHERE id = '$seller_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Seller not found.";
    exit;
}

// Proceed with message sending if seller exists
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $buyer_id = $_SESSION['user_id'];

    // Insert the message into the messages table
    $sql = "INSERT INTO messages (buyer_id, seller_id, ad_id, message) 
            VALUES ('$buyer_id', '$seller_id', '$ad_id', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
        
        // Optionally, notify the seller (via email or other means)
        $sql = "SELECT email FROM users WHERE id = '$seller_id'";
        $result = $conn->query($sql);
        $seller = $result->fetch_assoc();
        
        if ($seller) {
            $to = $seller['email'];
            $subject = "New Message Regarding Your Ad";
            $body = "You have received a new message for your ad titled: " . htmlspecialchars($ad['title']) . "\n\n" . "Message: " . htmlspecialchars($message);
            mail($to, $subject, $body);
        }
        
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Contact Seller for Ad: <?php echo htmlspecialchars($ad['title']); ?></h2>

<form action="contact_seller.php?ad_id=<?php echo $ad_id; ?>&seller_id=<?php echo $seller_id; ?>" method="POST">
    <label for="message">Your Message:</label><br>
    <textarea id="message" name="message" rows="4" required></textarea><br><br>
    
    <input type="submit" value="Send Message">
</form>

<!-- Back to Homepage -->
<a href="homepage.php">Back to Homepage</a>
