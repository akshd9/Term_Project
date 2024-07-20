<?php
require_once '../session.php';
require_once '../DB.php';
require_once '../helpers.php';

if (isset($_POST['login'])) {
    $contact = clean($_POST['contact']);
    $password = clean($_POST['password']);

    // Log the inputs for debugging
    error_log("Attempting login with contact: $contact");

    $provider = DB::query("SELECT * FROM providers WHERE contact = ?", [$contact])->fetch();

    if ($provider) {
        error_log("Provider found: " . print_r($provider, true));
    } else {
        error_log("No provider found with contact: $contact");
    }

    if ($provider && password_verify($password, $provider['password'])) {
        $_SESSION['provider_id'] = $provider['id'];
        header('Location: ../providerdashboard.php');
        exit();
    } else {
        // Log the failed attempt
        error_log("Login failed for contact: $contact");
        header('Location: ../providerlogin.php?msg=failed');
        exit();
    }
} else {
    // Log if login data was not posted
    error_log("No login data posted.");
    header('Location: ../providerlogin.php?msg=failed');
    exit();
}
?>
