<?php
require_once '../session.php';
require_once '../DB.php';
require_once '../helpers.php';

if (!isset($_SESSION['provider_id'])) {
    header('Location: ../providerlogin.php');
    exit();
}

$provider_id = $_SESSION['provider_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clean($_POST['name']);
    $contact = clean($_POST['contact']);
    $adder1 = clean($_POST['adder1']);
    $adder2 = clean($_POST['adder2']);
    $city = clean($_POST['city']);
    $descr = clean($_POST['descr']);
    $photo = $_FILES['photo'];

    $fields = [
        'name' => $name,
        'contact' => $contact,
        'adder1' => $adder1,
        'adder2' => $adder2,
        'city' => $city,
        'descr' => $descr,
    ];

    if (!empty($photo['name'])) {
        $file1 = upload($photo);
        if ($file1 !== false) {
            $fields['photo'] = $file1;
        }
    }

    $updateQuery = "UPDATE providers SET ";
    $updateParams = [];
    foreach ($fields as $key => $value) {
        $updateQuery .= "$key = ?, ";
        $updateParams[] = $value;
    }
    $updateQuery = rtrim($updateQuery, ', ') . " WHERE id = ?";
    $updateParams[] = $provider_id;

    $isUpdated = DB::query($updateQuery, $updateParams);

    if ($isUpdated) {
        header('Location: ../providerdashboard.php?msg=updated');
        exit();
    } else {
        header('Location: ../providerdashboard.php?msg=failed');
        exit();
    }
}
?>
