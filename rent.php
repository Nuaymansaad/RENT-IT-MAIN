<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect the user to the login page
    header("Location: login.html?redirect=true");
    exit();
}

// Check if the rental ID is provided in the query parameters
if (!isset($_GET["id"])) {
    // Redirect the user to the rentals page
    header("Location: rentals.php");
    exit();
}

// Retrieve the rental ID from the query parameters
$rentalId = $_GET["id"];

// Perform any necessary validation or verification for the rental ID
// ...

// Store the rental ID in a session variable or pass it along to the rental process
$_SESSION["rental_id"] = $rentalId;

// Redirect the user to the rental form or process the rental
header("Location: rental_form.php");
exit();
?>
