<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;
session_start();


//je connais déja l'id du job que l'employé cherche à valider et le login de l'employé
$id_job = $_POST['id_job'];
$login = $_SESSION['login'];

$errorMsg = array();


//on appel notre fonction pour mettre a jour la DT
$response = DBManagement::endJob($id_job);

if ($response == true){
    $errorMsg['endJob'] = true;
    echo json_encode($errorMsg);
}else{
    $errorMsg['endJob'] = false;
    echo json_encode($errorMsg);
}