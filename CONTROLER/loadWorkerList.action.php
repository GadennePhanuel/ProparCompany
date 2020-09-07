<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;

use ProparCompany\DBManagement;

/*
*   CONTROLLEUR POUR CHARGER L ENSEMBLE DES WORKERS DE LA DT
*/

$dbi = Singleton::getInstance()->getConnection();
$req = $dbi->prepare("SELECT id_worker, name, firstname, phone, dateHiring, status
                                FROM workers 
");
$req->execute();

$req = $req->fetchAll(PDO::FETCH_ASSOC);   //array 2 dimensions, chaque sous array =  un worker    sous-array['id_worker']=id_worker etc.....

echo json_encode($req);