<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;


$id_customer = $_POST['id_customer'];
$nameJobType = $_POST['nameJobType'];
$commentary = $_POST['commentary'];

if (
    isset($id_customer) && !empty($id_customer) &&
    isset($nameJobType) && !empty($nameJobType) &&
    isset($commentary) && !empty($commentary)
){
    DBManagement::addJob($id_customer, $commentary, $nameJobType);

    $errorMsg['check'] = true;

    echo json_encode($errorMsg);
}
else{
    $errorMsg['check'] = false;

    echo json_encode($errorMsg);
}

