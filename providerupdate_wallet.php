<?php
require_once '../session.php';
require_once '../DB.php';

if (!isset($_SESSION['provider_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$provider_id = $_SESSION['provider_id'];
$amount = $_POST['amount']; // The amount to add or subtract

$updated = DB::query("UPDATE providers SET wallet_balance = wallet_balance + ? WHERE id = ?", [
    $amount, $provider_id
]);

if ($updated) {
    echo json_encode(['message' => 'Wallet updated']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Update failed']);
}
?>
