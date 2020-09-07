<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;

$id_worker = $_POST['id_worker'];

DBManagement::modifyWorker($id_worker, 'expert');

echo json_encode(true);