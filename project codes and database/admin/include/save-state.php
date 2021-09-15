<?php

session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../../dbcon.php';



$statevalue = $_POST['ord_state'];
$product_id = $_POST['id'];

$query = "UPDATE `ord` SET `ord_state` = '$statevalue' WHERE `ord`.`oid` = $product_id;";
$result = $conn->query($query);

if ($result) {
    $_SESSION['msg']['type'] = 'success';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Sipariş Durumu Güncellendi !';
    header('location: ../order-items.php?id='.$product_id);
    exit;
} else {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Error: '.$conn->error;
    header('location: ../order-items.php?id='.$product_id);
    exit;
}
