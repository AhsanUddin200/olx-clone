<?php
session_start();
include('db.php');

// Ensure the user is logged in and is the seller of the ad
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your messages.";
    exit;
}

$seller_id = $_SESSION['user_id'];  // Get the logged-in seller's ID

// Fetch messages sent to this seller
$sql = "SELECT m.*, u.username AS buyer_username, a.title AS ad_title 
        FROM messages m 
        JOIN users u ON m.buyer_id = u.id 
        JOIN ads a ON m.ad_id = a.id 
        WHERE m.seller_id = '$seller_id' 
        ORDER BY m.created_at DESC";

$result = $conn->query($sql);

?>

<h2>Your Messages</h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='message'>";
        echo "<p><strong>Ad Title:</strong> " . htmlspecialchars($row['ad_title']) . "</p>";
        echo "<p><strong>From:</strong> " . htmlspecialchars($row['buyer_username']) . "</p>";
        echo "<p><strong>Message:</strong> " . nl2br(htmlspecialchars($row['message'])) . "</p>";
        echo "<p><em>Sent on: " . $row['created_at'] . "</em></p>";
        echo "</div>";
    }
} else {
    echo "<p>No messages.</p>";
}
?>

<!-- Back to Homepage -->
<a href="homepage.php">Back to Homepage</a>
