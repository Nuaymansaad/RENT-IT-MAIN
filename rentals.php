<?php
session_start();

// check if user is logged in
if (!isset($_SESSION["user_id"])) {
    echo "<div style=\"background-color: #f2f2f2; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;\">";
    echo "<p style=\"font-size: 24px; color: #333;\">You have not logged in.</p>";
    echo "<a href=\"login.html?redirect=true\" style=\"display: inline-block; background-color: #333; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px;\">Click here to go to the login page</a>";
    echo "</div>";

    exit();
}

// retrieve user ID from session
$user_id = $_SESSION["user_id"];

// connect to the database
$conn = mysqli_connect("localhost", "root", "", "rentit");

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve rental items from the database
$sql = "SELECT * FROM rental_items";
$result = mysqli_query($conn, $sql);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rentals - Rent It</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Rent It</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="cart.php">My Cart</a></li>
                    <li><a href="myprofile.php">My Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="rentals">
    <div class="container">
        <h2>Available Rentals</h2>
        <?php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rentals");

// Retrieve rental items from the database
$sql = "SELECT * FROM rental_items";
$result = mysqli_query($conn, $sql);

// Check for query execution errors
if (!$result) {
    echo "Error executing the query: " . mysqli_error($conn);
    exit();
}

// Check if any rental items were found
if (mysqli_num_rows($result) > 0) {
    // Loop through each rental item
    while ($row = mysqli_fetch_assoc($result)) {
        $rental_id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $image = $row['image'];

        // Display the rental item
        echo '<div class="rental-item">';
        echo '<img src="' . $image . '" alt="' . $name . '">';
        echo '<h3>' . $name . '</h3>';
        echo '<p>' . $description . '</p>';
        echo '<a href="rent.php?id=' . $rental_id . '" class="btn">Rent Now</a>';
        echo '</div>';
    }
} else {
    // No rental items found
    echo '<p>No rental items available.</p>';
}

// Close the database connection
mysqli_close($conn);

?>
    </div>
</section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Rent It</p>
        </div>
    </footer>
</body>
</html>
