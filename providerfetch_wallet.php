<?php
require_once '../session.php';
require_once '../DB.php';

if (!isset($_SESSION['provider_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$provider_id = $_SESSION['provider_id'];
$provider = DB::query("SELECT wallet_balance FROM providers WHERE id = ?", [$provider_id])->fetch();

if ($provider) {
    echo json_encode(['wallet_balance' => $provider['wallet_balance']]);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Error fetching wallet balance']);
}
?>
