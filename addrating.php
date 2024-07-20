<?php
require_once '../session.php'; // Adjust the path as per your file structure
require_once '../DB.php'; // Adjust the path as per your file structure

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php'); // Redirect to login page if not logged in
        exit();
    }

    // Retrieve POST data
    $provider_id = $_POST['provider_id'];
    $user_name = $_SESSION['user']->name; // Assuming you store user info in $_SESSION['user']
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert rating into database
    $sql = "INSERT INTO ratings (provider_id, user_name, rating, comment) VALUES (?, ?, ?, ?)";
    $params = [$provider_id, $user_name, $rating, $comment];

    try {
        DB::query($sql, $params); // Assuming DB::query executes the SQL statement
        header('Location: ../providerdetails.php?provider=' . $provider_id); // Redirect after successful insertion
        exit();
    } catch (PDOException $e) {
        // Handle database error
        echo "Error: " . $e->getMessage();
        // You might want to handle errors more gracefully, e.g., redirect to an error page
    }
} else {
    header('Location: ../index.php'); // Redirect if accessed directly without POST request
    exit();
}
?>
