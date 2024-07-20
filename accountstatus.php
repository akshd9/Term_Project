<?php
include_once "scripts/checklogin.php";
include_once "scripts/DB.php";

if (!check("admin")) {
    header('Location: logout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Fetch the current status of the provider
    $stmt = DB::query("SELECT status FROM providers WHERE id = ?", [$id]);
    $provider = $stmt->fetch(PDO::FETCH_OBJ);

    // Toggle the status
    $newStatus = ($provider->status == 'active') ? 'inactive' : 'active';

    // Update the status in the database
    DB::query("UPDATE providers SET status = ? WHERE id = ?", [$newStatus, $id]);

    // Redirect back to the main page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
