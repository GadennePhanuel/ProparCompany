<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;


$id_customer = $_POST['id_customer'];
$nameJobType = $_POST['nameJobType'];
$commentary = $_POST['commentary'];


DBManagement::addJob($id_customer, $commentary, $nameJobType);

$errorMsg['check'] = true;

echo json_encode($errorMsg);